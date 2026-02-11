<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WhyChooseUs>
 */
class WhyChooseUsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'description'=>'description',
        'icon1'=>'icon1',
        'title1'=>'title1',
        'desc1'=>'desc1',

        'icon2'=>'icon2',
        'title2'=>'title2',
        'desc2'=>'desc2',

        'icon3'=>'icon3',
        'title3'=>'title3',
        'desc3'=>'desc3',
        'slider_image'=>'save_url',
        ];
    }
}
