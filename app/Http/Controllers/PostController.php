<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Statuse;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $posts = Post::withCount('comments')->with('user', 'statues', 'category', 'image')->filter()->orderBy('id')->paginate(10);
        $data = $request->all();
        $statuses = Statuse::all();
        $categories = Category::all();

        return view('posts.index', ['posts' => $posts, 'data' => $data, 'statuses' => $statuses, 'categories' => $categories]);
    }

    public function create()
    {
        $statuses = Statuse::all();
        $categories = Category::where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();

        return view('posts.create', ['statuses' => $statuses, 'categories' => $categories, 'tags' => $tags]);
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $post = Post::create($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files');
            $post->image()->save(
                Image::make([
                    'path' => $path,
                ])
            );
        }

        return redirect()->route('posts.show', ['post' => $post->id])
            ->with('success', 'The blog post was created successfully');
    }

    public function show(string $id)
    {
        $post = Post::with('user', 'statues', 'category', 'image', 'comments', 'comments.user', 'comments.statues')->findOrFail($id);

        return view('posts.show', ['post' => $post]);
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $statuses = Statuse::all();
        $categories = Category::where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();

        return view('posts.edit', ['post' => $post, 'statuses' => $statuses, 'categories' => $categories, 'tags' => $tags]);
    }

    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validated();
        $post->user_id = $request->user()->id;
        $post->fill($validated);
        $post->save();

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('files');

            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    Image::make([
                        'path' => $path,
                    ])
                );
            }
        }

        return redirect()->route('posts.show', ['post' => $post->id])
            ->with('success', 'The blog post was updated successfully');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if($post) {
            $post->delete();
            $post->comments()->delete();
            return response()->json([
                'status' => 200,
                'message' => 'The blog post was deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Blog Post Found.'
            ]);
        }
//        $post->delete();
//        return redirect()->route('posts.index')
//            ->with('success', 'The blog post was deleted successfully');
    }
}
