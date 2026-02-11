<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'category_name_fr' => 'category',
                'category_slug_fr' => 'category-name',
                'category_image'=> 'upload/categories/1779571011172087.jpg',
                'created_at' => Carbon::now()
        ];
    }
}
