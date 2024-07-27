<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'image', 'tags')->get();

        return PostResource::collection($posts);
    }

    public function show(string $id)
    {
        $post = Post::with(
            'user',
            'statues',
            'tags',
            'category',
            'image',
            'comments',
            'comments.user',
            'comments.statues'
        )->findOrFail($id);

        return response()->json($post, 200);
    }

    public function addComment(string $id, Request $request)
    {
        $post = Post::findOrFail($id);

        $comment = new Comment();
        // $comment->content = 'test';
        // $comment->user_id = 1;
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $post->comments()->save($comment);

        return response()->json($post, 200);
    }
}
