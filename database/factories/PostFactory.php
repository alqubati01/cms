<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
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
            'title' => fake()->sentence(10),
            'short_description' => fake()->paragraphs(1, true),
            'content' => fake()->paragraphs(5, true),
            'statues_id' => fake()->numberBetween(1, 3),
            'visibility' => fake()->numberBetween(0, 1),
            'user_id' => fake()->numberBetween(1, 11),
            'category_id' => fake()->numberBetween(1, 7),
            'featured' => fake()->numberBetween(0, 1),
            'meta_title' => fake()->sentence(15),
            'meta_description' => fake()->paragraphs(2, true),
            'created_at' => fake()->dateTimeBetween('-3 months')
        ];
    }
}
