<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->text(),
            'user_id' => fake()->numberBetween(1, 11),
            'statues_id' => fake()->numberBetween(1, 3),
            'created_at' => fake()->dateTimeBetween('-3 months')
        ];
    }
}
