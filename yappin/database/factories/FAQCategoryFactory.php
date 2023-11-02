<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FAQCategoryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => 'Category ' . fake()->unique()->word,
        ];
    }

}
