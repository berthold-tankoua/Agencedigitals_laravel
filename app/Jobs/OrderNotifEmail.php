<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class OrderNotifEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
        protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function handle() {
        $order = Order::findOrfail($this->data);
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
}
