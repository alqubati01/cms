<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Statuse;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = Statuse::all();
        $users = User::all();
        $categories = Category::all();

        Post::factory(35)->make()->each(function ($post) use ($statuses, $users, $categories) {
            $post->statues_id = $statuses->random()->id;
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->save();
        });
    }
}
