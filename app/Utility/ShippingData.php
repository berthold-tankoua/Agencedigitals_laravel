<?php
namespace App\Utility;
use App\Models\Currency;



class ShippingData
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $phone;
    public string $country;
    public string $town;
    public  float $totalPrice;
    public string $cartCurrency;
    public string $postCode;
    public string $quarter;
    public string $notes;

    public function __construct(array $data)
    {
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->email = $data['email'];
        $this->phone = $data['user_phone'] ?? $data['phone'];

        $this->country = $data['country'];
        $this->town = $data['town'];
        $this->postCode = $data['post_code'] ?? "237";
        $this->quarter = $data['quarter'];

        $this->notes = $data['notes'] ?? "Aucune";

        $this->totalPrice = $data['totalPrice'];
        $this->cartCurrency = $data['cartCurrency'];
    }
}
