<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('posts')->get();

        return response()->json($tags, 200);
    }

    public function show(string $id)
    {
        $tag = Tag::withCount('posts')->findOrFail($id);

        return response()->json($tag, 200);
    }

    public function getPostsByTag($tag)
    {
        $tag = Tag::findOrFail($tag);
        $posts = $tag->posts()->with('user', 'image', 'tags')->get();

        return response()->json($posts, 200);
    }

    public function getVideosByTag($tag)
    {
        $tag = Tag::findOrFail($tag);
        $videos = $tag->videos()->with('user', 'tags')->get();

        return response()->json($videos, 200);
    }

    public function getPodcastsByTag($tag)
    {
        $tag = Tag::findOrFail($tag);
        $podcasts = $tag->podcasts()->with('user', 'tags')->get();

        return response()->json($podcasts, 200);
    }
}
