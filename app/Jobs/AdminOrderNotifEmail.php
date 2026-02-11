<?php

namespace App\Jobs;

use App\Mail\AdminOrderMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AdminOrderNotifEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function handle() {
        $order = Order::findOrfail($this->data);
        $order_admin_Info=[
            'payment_type' => $order->payment_type,
            'invoice_no' => $order->invoice_no,
            'amount' => $order->amount.' '.$order->currency,
            'name' => $order->name,
            'email' => $order->email,
        ];
        Mail::to("brtankoua@gmail.com")->send(new AdminOrderMail($order_admin_Info));

    }
}
