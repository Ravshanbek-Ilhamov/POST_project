<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LikeOrDislike>
 */
class LikeOrDislikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id'=>fake()->numberBetween(1,30),
            'user_id'=>fake()->numberBetween(1,20),
            'value'=>fake()->boolean(40)
        ];
    }
}
