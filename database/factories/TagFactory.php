<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'is_active' => fake()->numberBetween(0, 1),
            'meta_title' => fake()->sentence(15),
            'meta_description' => fake()->paragraphs(2, true),
            'created_at' => fake()->dateTimeBetween('-3 months')
        ];
    }
}
