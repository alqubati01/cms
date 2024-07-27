<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory()
            ->count(10)
            ->sequence(
                ['name' => 'Art'],
                ['name' => 'Education'],
                ['name' => 'Marketing'],
                ['name' => 'SEO'],
                ['name' => 'Software'],
                ['name' => 'Health'],
                ['name' => 'Fitness'],
                ['name' => 'Travel'],
                ['name' => 'Business'],
                ['name' => 'Design'],
            )
            ->create();
    }
}
