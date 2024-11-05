<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_IP'=>fake()->ipv4(),
            'request_id'=>fake()->numberBetween(1,10),
            'option_id'=>fake()->numberBetween(1,30),
        ];
    }
}
