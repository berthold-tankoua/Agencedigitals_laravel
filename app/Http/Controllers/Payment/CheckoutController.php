<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Utility\ShippingData;

use App\Services\CheckoutService;

use App\Payments\CinetpayPayment;
use App\Payments\NotchpayPayment;
use App\Payments\FreePayment;
use App\Payments\StripePayment;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Utility\Utility;
use Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected CheckoutService $checkoutService;

    public function __construct(CheckoutService $checkoutService){
        $this->checkoutService = $checkoutService;
    }

    public function ProductCheckout(){

        if(Cart::total() > 0){
            $cartCurrency = Cart::content()->first()->options->currency;
            $transitFee = Utility::specific_currency_convert($cartCurrency,15000);
            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
            $totalPrice = Cart::total()+$transitFee;
            return view('frontend.pages.checkout.checkout',compact('cartCurrency','transitFee','carts','cartQty','cartTotal','totalPrice'));
        }else{
            $notification = array(
                'message' =>'Veuillez ajouter un produit au panier d achat',
                'alert-type'=>'error'
            );
            return redirect('/')->with($notification);
        }

    }
    public function checkoutStore(Request $request){

        $shippingData = new ShippingData($request->all());
        $totalPrice = $this->checkoutService->convertPrice($request->totalPrice);

        $paymentMethod = $request->payment_method;
        $paymentClass = match ($paymentMethod) {
            'cinetpay'  => new CinetpayPayment(),
            'notchpay'  => new NotchpayPayment(),
            'stripe'  => new StripePayment(),
            'free'      => new FreePayment(),
            default     => throw new \Exception("Méthode de paiement inconnue"),
        };

        return $paymentClass->process($shippingData, $totalPrice);

    }

    function InvoiceView(){
        if (Auth::check()) {
         $order = Order::where('user_id',Auth::id())->latest()->first();
         $orderItems = OrderItem::where('order_id',$order->id)->get();

         return view('frontend.pages.payment.invoice.invoice',compact('order','orderItems'));
        } else {
            return redirect()->route('user.login');
        }

    }

    function SendInvoiceMail(){
        $orders = Order::where(function($query) {
        $query->where('status', 'paid')
              ->orWhere('status', 'partial_paid');
        })->whereNull('invoice')->get();

        foreach ($orders as $order) {
            $orderItems = OrderItem::where('order_id',$order->id)->get();
            $pdf = Pdf::loadView('frontend.pages.payment.invoice.invoice', [
                'order' => $order,
                'orderItems' => $orderItems
            ]);
            // Sauvegarder temporairement si besoin
            $pdfPath = public_path('upload/invoices/invoice_'.$order->id.'.pdf');

            $pdfUrl = asset('upload/invoices/invoice_'.$order->id.'.pdf');
            $order->invoice = $pdfUrl;
            $order->save();
            $pdf->save($pdfPath);

            $OrderInfo=[
                'order_id' => $order->id,
                'payment_type' => $order->payment_type,
                'invoice_no' => $order->invoice_no,
                'amount' => $order->amount.' '.$order->currency,
                'name' => $order->name,
                'email' => $order->email,
                'invoice' => $order->invoice,
           ];
           Mail::to("$order->email")->send(new OrderMail($OrderInfo));
        }
        return ['status' => true];
    }

}
