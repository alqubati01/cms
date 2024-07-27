<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Podcast;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        $videos = Video::all();
        $podcasts = Podcast::all();

        Comment::factory(100)->make()->each(function ($comment) use ($posts) {
            $comment->commentable_type = 'App\Models\Post';
            $comment->commentable_id = $posts->random()->id;
            $comment->save();
        });

        Comment::factory(50)->make()->each(function ($comment) use ($videos) {
            $comment->commentable_type = 'App\Models\Video';
            $comment->commentable_id = $videos->random()->id;
            $comment->save();
        });

        Comment::factory(50)->make()->each(function ($comment) use ($podcasts) {
            $comment->commentable_type = 'App\Models\Podcast';
            $comment->commentable_id = $podcasts->random()->id;
            $comment->save();
        });
    }
}
