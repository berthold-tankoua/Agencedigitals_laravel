<?php
namespace App\Payments;

use App\Utility\ShippingData;

class CinetpayPayment implements PaymentMethodInterface
{
    public function process(ShippingData $data, float $total)
    {
        return view('frontend.pages.payment.confirm.cinetpay', compact('data', 'total'));
    }
}
