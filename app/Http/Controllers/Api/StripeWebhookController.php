<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderInstallment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    //
    public function handleWebhook(Request $request){

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET'); // à configurer dans .env

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sigHeader, $endpointSecret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            return response('Invalid payload', 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('Invalid signature', 400);
        }

        // Handle the checkout.session.completed event
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            // Exemple : mettre à jour ta commande en 'Paid'
            $orderNumber = $session->id;

            $order = Order::where('transaction_id', $orderNumber)->first();
            if ($order) {
                $order->status = 'Paid';
                $order->save();
            }

            // Tu peux ajouter ici l'envoi d'email, log, etc.
        }

        return response('Webhook handled', 200);
    }

    public function handleStripeWebhook(Request $request){
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $payload    = $request->getContent();
        $sigHeader  = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sigHeader, $endpointSecret
            );
        } catch(\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // 🎯 Quand une facture est payée
        if ($event->type === 'invoice.paid') {
            $invoice = $event->data->object;
            $subscriptionId = $invoice->subscription;

            // Récupère ta commande liée à cette subscription
            $order = Order::where('stripe_subscription_id', $subscriptionId)->where('status','!=', 'paid')->first();
            if ($order->installments_paid>1) {
                $order->status = 'partial_paid';
                $order->stripe_subscription_id = $subscriptionId;
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
                    // ✅ Annuler la subscription Stripe
                    \Stripe\Subscription::update($subscriptionId, [
                        'cancel_at_period_end' => true
                    ]);
                    $order->status = 'paid';
                    $order->fully_paid = true;
                }

                $order->save();
            }
        }

        // Handle the checkout.session.completed event
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            // Exemple : mettre à jour ta commande en 'Paid'
            $order = Order::where('transaction_id', $session->id)->where('status','!=', 'paid')->first();
            if ($order) {
                $order->installments_paid = 1;
                $order->next_payment_date = null;
                $order->fully_paid = true;
                $order->status = 'paid';
                $order->save();
            }

            // Tu peux ajouter ici l'envoi d'email, log, etc.
        }

        return response('Webhook handled', 200);
    }

}
