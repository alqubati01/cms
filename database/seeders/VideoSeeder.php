<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Statuse;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = Statuse::all();
        $users = User::all();
        $categories = Category::all();

        Video::factory(35)->make()->each(function ($video) use ($statuses, $users, $categories) {
            $video->statues_id = $statuses->random()->id;
            $video->user_id = $users->random()->id;
            $video->category_id = $categories->random()->id;
            $video->save();
        });
    }
}
