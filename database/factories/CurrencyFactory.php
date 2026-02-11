<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'name' => 'name',
                'code' => 'code',
                'symbol' => 'symbol',
                'exchange_rate' => 11,
                'status' => 'active',
                'created_at' => Carbon::now()
        ];
    }
}
