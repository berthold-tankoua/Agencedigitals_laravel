<?php
namespace App\Payments;

use App\Utility\ShippingData;

class NotchpayPayment implements PaymentMethodInterface
{
    public function process(ShippingData $data, float $total)
    {
        return view('frontend.pages.payment.notchpay', compact('data', 'total'));
    }
}
