<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FAQItemFactory extends Factory
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
            'category_id' => fake()->numberBetween(1,3),
            'question' => fake()->sentence,
            'answer' => fake()->paragraph,
        ];
    }

}
