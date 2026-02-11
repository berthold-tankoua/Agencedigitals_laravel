<?php
namespace App\Payments;

use App\Utility\ShippingData;

interface PaymentMethodInterface
{
    public function process(ShippingData $data, float $total);
}
