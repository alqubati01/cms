<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Podcast;
use App\Models\Statuse;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PodcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = Statuse::all();
        $users = User::all();
        $categories = Category::all();

        Podcast::factory(35)->make()->each(function ($podcast) use ($statuses, $users, $categories) {
            $podcast->statues_id = $statuses->random()->id;
            $podcast->user_id = $users->random()->id;
            $podcast->category_id = $categories->random()->id;
            $podcast->save();
        });
    }
}
