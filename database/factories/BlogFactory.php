<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'author'=>'author',
                'type'=>'type',
                'author_note'=>'author_note',
                'title1'=>'title1',
                'short_desc'=>'short_desc',
                'long_desc'=>'long_desc',
                'tags'=>'tags',
                'blog_img'=>'save_url',
                'created_at' => Carbon::now()
        ];
    }
}
