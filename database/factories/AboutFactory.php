<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'country'=>'country',
            'phone'=>'phone',
            'email'=>'email',
            'desc1'=>'desc1',
            'desc2'=>'desc2',
            'desc3'=>'desc3',
            'desc4'=>'desc4',
            'desc5'=>'desc5',
            'facebook_link'=>'flink',
            'instagram_link'=>'ilink',
            'twitter_link'=>'tlink',
            'about_img'=>'save_url',
        ];
    }
}
