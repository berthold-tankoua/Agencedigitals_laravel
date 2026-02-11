<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Store;
use App\Models\OrderItem;
use App\Models\Subscription;
use App\Models\Property;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use Cart;
use App\Utility\Utility;
use NotchPay\NotchPay;
use NotchPay\Payment;

class NotchpayController extends Controller
{
        public function NotchpayAction(Request $request){

        $country = Country::findOrFail($request->country);
        $country_iso = $country->iso_2;
        $amount = Utility::get_price($request->total_amount) ;
        $currency = Utility::currency_code();
        $customer_name = $request->name;
        $customer_surname = $request->name;
        $description ="Paiement Via la Plateforme Notchpay";
        //transaction id
        $transaction_generate = date("YmdHis");
        $id_transaction = Auth::id().$transaction_generate;

        $get_sub = Subscription::findOrFail($request->subscription_id);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'coutry' => $country->country_fr,
            'subscription_id' => $request->subscription_id,
            'store_id' => Auth::user()->store_id,
            'property_id' => $request->property_id,
            'town' => $request->town,
            'quarter' => $request->quarter,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'payment_type' => 'Renouvelement de l abonnement '.$request->subscription_name,
            'payment_method' => 'Notchpay',
            'transaction_id' => $id_transaction,
            'currency' => $currency,
            'amount' =>  floatval($amount),
            'order_number' => $id_transaction,
            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Attente',
            'created_at' => Carbon::now(),
        ]);

        //Notchpay start
        NotchPay::setApiKey('sb.69PXWPHmk3XFclqbIDneXR9pPaVV7L2chJx4AqPoxOI9j2bAxZGrjLcejKWb6cKp6krRHQQprSOqckYdWdQnfQVL7nZO1ofIV6WRDs9YuV4albQju5uJpwKAQP0IR');
        try {
            $tranx = Payment::initialize([
                'amount'=>$amount,   // according to currency format
                'email'=>$request->email,   // unique to customers
                'currency'=>$currency,  // currency iso code
                'callback'=>'http://127.0.0.1:8000/notchpay/check/',  // optional callback url
                'reference'=>"$id_transaction", // unique to transactions
            ]);
        } catch(\NotchPay\Exceptions\ApiException $e){
            print_r($e->errors);
            die($e->getMessage());
        }

        // redirect to page so User can pay
        $payment_url = $tranx->authorization_url; // Redirect customer to this url
        return redirect($payment_url);
        //Notchpay end

    }

    public function NotchpayCheckOrder(){

        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        $id = isset($_GET['trxref']) ? $_GET['trxref'] : '';
        if(!$reference){
          die('No reference supplied');
        }
        // initiate the Library's NotchPay Object
        NotchPay::setApiKey('sb.69PXWPHmk3XFclqbIDneXR9pPaVV7L2chJx4AqPoxOI9j2bAxZGrjLcejKWb6cKp6krRHQQprSOqckYdWdQnfQVL7nZO1ofIV6WRDs9YuV4albQju5uJpwKAQP0IR');

        try {
        $tranx = Payment::verify($reference);

        if ($tranx->transaction->status === 'complete') {
            $item = Order::where('transaction_id',$id)->first();
            $user_id= $item->user_id;
            $store_id= $item->store_id;
            $store = Store::findOrfail($store_id);
            $store_sub = Subscription::findOrfail($store->subscription_id);

            Order::where('transaction_id',$id)->update([
                'processing_date' => Carbon::now()->format('d F Y'),
                'confirmed_date' => Carbon::now()->format('d F Y'),
                'delivered_date' => Carbon::now()->format('d F Y'),
                'status'=>'Termine',
            ]);
            Store::where('user_id',$user_id)->update([
                'subscription_id' => $item->subscription_id,
                'expiry_date' => Carbon::now()->addDay($store_sub->validity),
                'status'=>1,
            ]);
            Property::where('store_id',$store_id)->update([
                'subscription_id' => $item->subscription_id,
                'status'=>1,
            ]);

            $notification = array(
                'message' => 'Votre Paiement a ete effectue avec succes',
                'alert-type' => 'success'
            );
            return redirect()->route('cinetpay.success')->with($notification);
        }else {
            $notification = array(
                'message' => 'Votre Paiement a echouer',
                'alert-type' => 'error'
            );
            Order::where('transaction_id',$id)->update([
                'processing_date' => Carbon::now()->format('d F Y'),
                'confirmed_date' => Carbon::now()->format('d F Y'),
                'cancel_date' => Carbon::now()->format('d F Y'),
                'status'=>'Echouer',
            ]);
            return redirect()->route('notchpay.cancel')->with($notification);
        }
    } catch(\NotchPay\Exceptions\ApiException $e){
        print_r($e->errors);
        die($e->getMessage());
    }
    }

    public function NotchpaySuccess(Request $request){

        return view('frontend.pages.payment.notchpay.success');
    }

    public function NotchpayCancel(Request $request){

         return view('frontend.pages.payment.notchpay.cancel');
    }
}
