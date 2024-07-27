<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::with('user', 'tags')->get();

        return response()->json($podcasts, 200);
    }

    public function show(string $id)
    {
        $podcast = Podcast::with(
            'user',
            'statues',
            'category',
            'comments',
            'comments.user',
            'comments.statues'
        )->findOrFail($id);

        return response()->json($podcast, 200);
    }

    public function addComment(string $id)
    {
        $podcast = Podcast::findOrFail($id);

        $comment = new Comment();
        $comment->content = 'test';
        $comment->user_id = 1;
        $podcast->comments()->save($comment);

        return response()->json($podcast, 200);
    }
}
