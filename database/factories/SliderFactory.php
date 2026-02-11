<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'slider_title' => 'title',
            'slider_small1' => 'slider_small1',
            'slider_small2' => 'slider_small2',
            'slider_desc' => 'slider_desc',
           
            'slider_image_1' => 'slider_image_1',
            'slider_image_2' => 'slider_image_2',
            'font_size' => 'font_size',
            'status' => 1,
        ];
    }
}
