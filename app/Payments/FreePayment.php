<?php

namespace App\Payments;

use App\Utility\ShippingData;

class FreePayment implements PaymentMethodInterface
{
    public function process(ShippingData $data, float $total)
    {
        return view('frontend.pages.payment.confirm.free', compact('data', 'total'));
    }
}

