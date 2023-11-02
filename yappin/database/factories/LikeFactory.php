<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'post_id' => fake()->numberBetween(1, 20),
            'user_id' => fake()->numberBetween(1, 10),
        ];
    }

}
