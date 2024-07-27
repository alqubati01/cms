<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            'name' => fake()->name(),
//            'parent_id' => fake()->randomElement([NULL, 2, 4, 7]),
            'is_active' => fake()->numberBetween(1, 1),
            'short_description' => fake()->paragraphs(1, true),
            'meta_title' => fake()->sentence(15),
            'meta_description' => fake()->paragraphs(2, true),
            'created_at' => fake()->dateTimeBetween('-3 months')
        ];
    }
}
