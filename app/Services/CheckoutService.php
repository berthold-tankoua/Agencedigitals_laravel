<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Utility\Utility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Cart;

class CheckoutService
{
    public function convertPrice($price): float {

        $convertPrice = Utility::get_price($price);

        return $convertPrice ?? 0;
    }

    public function storeOrder(array $data,$transactionId,$amount,$currency,$paymentType){

        $carts = Cart::content();
       // nombre de tranches prévues ==1
        if ($data['installments_count']==1) {
            $totalPrice = $amount;
        } else {
            $totalPrice = round($amount / 3, 0);
        }

        $user=User::where('email',$data['email'])->first();
        if ($user) {
            $userId=$user->id;
        } else {
            $userId = User::insertGetId([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => $data['phone'],

            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'last_seen' => Carbon::now(),
           ]);
        }

        $orderId= Order::insertGetId([
          'user_id' => $userId,
          'name' => $data['last_name'],
          'first_name' => $data['first_name'],
          'email' => $data['email'],
          'phone' => $data['phone'],

          'town' => $data['town'],
          'quarter' => $data['quarter'],
          'country' => $data['country'],

          'post_code' => $data['post_code'],
          'notes' => $data['notes'],
          'payment_type' => 'Achat des produits ',
          'payment_method' => $paymentType,
          'transaction_id' => $transactionId,

          'installments_count' => $data['installments_count'],
          'installment_amount' => $totalPrice,
          'currency' => $currency,
          'amount' =>  $amount,

          'order_number' => 'EOS'.mt_rand(10000000,99999999),
          'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
          'order_date' => Carbon::now()->format('d F Y'),
          'order_month' => Carbon::now()->format('F'),
          'order_year' => Carbon::now()->format('Y'),
          'processing_date' => Carbon::now()->format('d F Y'),
          'confirmed_date' => Carbon::now()->format('d F Y'),

          'status'=>'pending',
          'created_at' => Carbon::now(),
      ]);

        foreach ($carts as $cart) {
           OrderItem::insert([
               'order_id' => $orderId,
               'product_id' => $cart->id,
               'color' => $cart->options->color,
               'size' => $cart->options->size,
               'qty' => $cart->qty,
               'price' => $cart->price,
               'currency' => $cart->options->currency,
               'created_at' => Carbon::now(),
           ]);
        }

      return $orderId;
    }
}
