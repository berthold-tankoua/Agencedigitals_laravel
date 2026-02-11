<?php
namespace App\Payments;

use App\Utility\ShippingData;

class StripePayment implements PaymentMethodInterface
{
    public function process(ShippingData $data, float $total)
    {
        return view('frontend.pages.payment.confirm.stripe', compact('data', 'total'));
    }
}
