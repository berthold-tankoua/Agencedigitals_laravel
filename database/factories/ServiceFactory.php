<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_name_fr' => 'service_name_fr',
            'service_slug_fr' => 'service_name_fr',
            'short_descp_fr' => 'short_descp_fr',
            'service_link' => 'link',
            'service_thambnail' => 'save_url',
            'status' => 1,
            'created_at' => Carbon::now(),
        ];
    }
}
