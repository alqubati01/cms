<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()
            ->count(7)
            ->sequence(
//                ['name' => 'Sciences', 'parent_id' => NULL],
//                ['name' => 'Time Management', 'parent_id' => 1],
//                ['name' => 'Marketing', 'parent_id' => 1],
//                ['name' => 'Technology', 'parent_id' => 2],
//                ['name' => 'Negotiation', 'parent_id' => 3],
//                ['name' => 'Self Development', 'parent_id' => NULL],
//                ['name' => 'Psychological Health', 'parent_id' => NULL],
                ['name' => 'Sciences'],
                ['name' => 'Time Management'],
                ['name' => 'Marketing'],
                ['name' => 'Technology'],
                ['name' => 'Negotiation'],
                ['name' => 'Self Development'],
                ['name' => 'Psychological Health'],
            )
            ->create();
    }
}
