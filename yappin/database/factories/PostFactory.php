<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'title' => fake()->sentence,
            'content' => fake()->paragraph,
            'cover_image' => null,
            'is_edited' => fake()->boolean(10),
        ];
    }

}
