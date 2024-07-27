<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->get();

        return response()->json($categories, 200);
    }

    public function show(string $id)
    {
        $category = Category::withCount('posts')->findOrFail($id);

        return response()->json($category, 200);
    }

    public function getPostsByCategory($category)
    {
        $category = Category::findOrFail($category);
        $posts = $category->posts()->with('user', 'image', 'tags')->get();

        return response()->json($posts, 200);
    }

    public function getVideosByCategory($category)
    {
        $category = Category::findOrFail($category);
        $videos = $category->videos()->with('user', 'tags')->get();

        return response()->json($videos, 200);
    }

    public function getPodcastsByCategory($category)
    {
        $category = Category::findOrFail($category);
        $podcasts = $category->podcasts()->with('user', 'tags')->get();

        return response()->json($podcasts, 200);
    }
}
