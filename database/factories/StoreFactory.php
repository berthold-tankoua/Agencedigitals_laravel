<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'agent_category' => 'agent_category',
            'store_name' => 'store_name',
            'subscription_id' => null,
            'store_name_slug' => 'store-name',
            'store_adress' => 'store_adress',
            'store_contact' => 'user_phone',
            'store_email' => 'email',
            'store_descp_fr' => 'Nous mettons à votre disposition une sélection de propriétés soigneusement choisies pour répondre à vos besoins.',
            'store_thambnail' => 'upload/image.png',
            'status' => 1,
            'raiting' => 5,
            'created_at' => Carbon::now(),
        ];
    }
}
