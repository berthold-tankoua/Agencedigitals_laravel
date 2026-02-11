<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\AdminOrderNotifEmail;
use App\Jobs\OrderNotifEmail;
use App\Models\Order;
use App\Models\OrderInstallment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\CheckoutService;
use App\Utility\Utility;
use Carbon\Carbon;
use Cart;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripeController extends Controller
{

    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {

        $this->checkoutService = $checkoutService;
    }

    // Stripe method : CheckoutPage
    public function StripeCheckoutPage(Request $request)
    {

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $currency = strtolower($request->currency ?? 'usd');
        $domain   = rtrim(env('APP_URL'), '/');
        $total    = (float) $request->totalPrice;

        // Stripe exige les montants en centimes
        $toStripeAmount = function ($value) use ($currency) {
            return $currency === 'usd'
                ? intval(round($value * 100)) // USD → en cents
                : intval(round($value));      // autres devises → suppose déjà en "plus petite unité"
        };

        if ($request->installments_count == 1) {
            // ✅ Paiement unique
            $amount = $toStripeAmount($total);

            $session = \Stripe\Checkout\Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => [
                            'name' => 'AgenceDigitals | Paiement intégral',
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $domain . '/stripe/payment/status?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => $domain . '/stripe/payment/cancel',
            ]);
        } else {
            // ✅ Paiement en 3 tranches automatiques (abonnement limité à 3 mois)
            $installmentAmount = $total / 3;
            $amount  = $toStripeAmount($installmentAmount);

            // 1️⃣ Créer un produit "Abonnement 3x"
            $productId = env('STRIPE_PRODUCT_ID');

            // 2️⃣ Créer un prix récurrent
            $price = \Stripe\Price::create([
                'unit_amount' => $amount,
                'currency'    => $currency,
                'recurring'   => [
                    'interval' => 'month',
                    'interval_count' => 1,
                ],
                'product' => $productId,
            ]);

            // 3️⃣ Créer une Checkout Session pour la souscription
            $session = \Stripe\Checkout\Session::create([
                'mode' => 'subscription',
                'line_items' => [[
                    'price' => $price->id,
                    'quantity' => 1,
                ]],
                'success_url' => $domain . '/stripe/payment/status?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => $domain . '/stripe/payment/cancel',
                // tu dois avoir un Stripe Customer (lié à ton User)
                // si tu veux stopper automatiquement après 3 paiements,
                // il faudra écouter le webhook "invoice.paid" et annuler la subscription après 3 paiements
            ]);
        }

        // ✅ Stocker la commande
        $transactionId = $session->id;
        $orderId = $this->checkoutService->storeOrder(
            $request->all(),
            $transactionId,
            $total,
            $currency,
            'Stripe Service'
        );

        // ✅ Notification admin
        dispatch(new AdminOrderNotifEmail($orderId));

        return redirect()->away($session->url);
    }

    // Stripe method : CheckoutPage for remainin Order
    public function StripePaidRemainingOrder(Request $request)
    {

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $orderId = $request->orderId;
        $currency = strtolower($request->currency ?? 'usd');
        $domain   = rtrim(env('APP_URL'), '/');
        $total    = (float) $request->totalPrice;

        // Stripe exige les montants en centimes
        $toStripeAmount = function ($value) use ($currency) {
            return $currency === 'usd'
                ? intval(round($value * 100)) // USD → en cents
                : intval(round($value));      // autres devises → suppose déjà en "plus petite unité"
        };

        $amount = $toStripeAmount($total);
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => 'AgenceDigitals | Paiement intégral',
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => [
                'order_id' => $orderId, // 👈 ici tu passes ton ID de commande
                'user_id' => Auth::id(),
            ],
            'success_url' => $domain . '/stripe/payment/status?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => $domain . '/stripe/payment/cancel',
        ]);

        // Notifier admin
        dispatch(new AdminOrderNotifEmail($orderId));

        return redirect()->away($session->url);
    }

    // Stripe methode 2 END

    // Stripe Payment Statut
    public function StripePaymentStatus(Request $request)
    {

        $sessionId = $request->get('session_id');
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }

            $customer = \Stripe\Customer::retrieve($session->customer);
        } catch (\Exception $e) {
            throw new NotFoundHttpException;
        }

        $remaingPaid = $session->metadata->order_id ?? null;
        if ($remaingPaid) {
            $order = Order::where('id', $remaingPaid)->first();
        } else {
            $order = Order::where('transaction_id', $sessionId)->first();
        }

        // ---------- MODE SUBSCRIPTION ----------
        if ($session->mode === 'subscription' && $session->subscription) {
            $subscription = \Stripe\Subscription::retrieve($session->subscription);

            if ($subscription->status === 'active') {
                $order->status = 'partial_paid';
                $order->stripe_subscription_id = $subscription->id;
                $order->installments_paid += 1;
                $order->confirmed_date = Carbon::now()->format('d F Y');
                $order->next_payment_date = now()->addMonth();

                OrderInstallment::insert([
                    'order_id' => $order->id,
                    'amount' => $order->installment_amount,
                    'transaction_id' => $order->transaction_id,
                    'due_date' => now(),
                    'status' => 'paid',
                ]);

                if ($order->installments_paid >= $order->installments_count) {
                    $order->fully_paid = true;
                    $order->status = 'paid';
                    $subscription->cancel(); // Annule la souscription Stripe immédiatement
                }
                $order->save();

                dispatch(new OrderNotifEmail($order->id));
                return view('frontend.pages.payment.status.success');
            } else {
                $order->status = 'failed';
                $order->save();

                return view('frontend.pages.payment.status.error', [
                    'order' => $order,
                    'errorMessage' => "Le paiement mensuel a échoué ou est incomplet."
                ]);
            }
        }
        // ---------- MODE PAIEMENT UNIQUE ----------
        if ($session->payment_status === 'paid') {

            if ($remaingPaid) {
                if ($order->installments_count == 3) {
                    if (!empty($order->stripe_subscription_id)) {
                        $subscription = \Stripe\Subscription::retrieve($order->stripe_subscription_id);
                        $subscription->cancel();
                    }
                    $order->installments_paid = $order->installments_count;
                    OrderInstallment::where('order_id', $order->id)->delete();
                } else {
                    $order->installments_paid = 1;
                }
            }

            $order->confirmed_date = Carbon::now()->format('d F Y');
            $order->next_payment_date = null;
            $order->fully_paid = true;
            $order->status = 'paid';
            $order->save();

            dispatch(new OrderNotifEmail($order->id));
            return view('frontend.pages.payment.status.success');
        }

        // ---------- PAIEMENT ÉCHOUÉ ----------
        if ($session->payment_status === 'failed') {
            if ($order) {
                $order->status = 'failed';
                $order->save();
            }

            $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
            $errorMessage = $paymentIntent->last_payment_error->message ?? 'Le paiement a échoué.';

            return view('frontend.pages.payment.status.error', compact('order', 'errorMessage'));
        }

        // Cas particulier (pas de paiement requis)
        return redirect('/')->with('info', 'Aucun paiement requis pour cette commande.');
    }


    public function StripeCancel()
    {
        $notification = [
            'message' => 'Vous avez annulé le paiement via Stripe.',
            'alert-type' => 'error'
        ];
        return redirect('/')->with($notification);
    }

    public function createInstallmentCheckoutSession($order)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $currency = $order->currency;
        $domain   = rtrim(env('APP_URL'), '/');

        $installmentAmount = $order->total_amount / $order->installments_count;
        $amount = $currency === 'usd'
            ? intval(round($installmentAmount * 100))
            : intval(round($installmentAmount));

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => ['name' => 'Paiement tranche'],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $domain . '/stripe/payment/status?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => $domain . '/stripe/payment/cancel',
            'metadata' => [
                'order_id' => $order->id,
                'tranche'  => $order->installments_paid + 1,
            ],
        ]);


        return $session->url; // ⚡ lien à envoyer au client
    }
}
