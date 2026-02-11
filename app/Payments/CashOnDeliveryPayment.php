<?php
namespace App\Payments;

use App\Utility\ShippingData;

class CashOnDeliveryPayment implements PaymentMethodInterface
{
    public function process(ShippingData $data, float $total)
    {
        // Ici, on pourrait enregistrer la commande directement comme "à payer"
        return view('frontend.pages.payment.confirm.cod', compact('data', 'total'));
    }
}
