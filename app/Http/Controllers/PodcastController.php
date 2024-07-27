<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Podcast;
use App\Models\Statuse;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PodcastController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $podcasts = Podcast::withCount('comments')->with('user', 'statues', 'category')->filter()->orderBy('id')->paginate(10);
        $data = $request->all();
        $statuses = Statuse::all();
        $categories = Category::all();

        return view('podcasts.index', ['podcasts' => $podcasts, 'data' => $data, 'statuses' => $statuses, 'categories' => $categories]);
    }

    public function create()
    {
        $statuses = Statuse::all();
        $categories = Category::where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();

        return view('podcasts.create', ['statuses' => $statuses, 'categories' => $categories, 'tags' => $tags]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'bail|required|unique:podcasts,title|min:5|max:100',
            'content' => 'required|string|min:10',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'statues_id' => 'integer',
            'visibility' => 'integer',
            'category_id' => 'required|integer',
            'featured' => 'integer',
            'tags' => 'array'
        ]);

        $validated['user_id'] = $request->user()->id;

        if ($request->hasFile('podcast')) {
            $path = $request->file('podcast')->store('podcasts');
            $validated['path'] = $path;
        }

        $podcast = Podcast::create($validated);

        if ($request->has('tags')) {
            $podcast->tags()->sync($request->tags);
        }

        return redirect()->route('podcasts.show', ['podcast' => $podcast->id])
            ->with('success', 'The blog podcast was created successfully');
    }

    public function show(string $id)
    {
        $podcast = Podcast::with('user', 'statues', 'category', 'comments', 'comments.user', 'comments.statues')->findOrFail($id);

        return view('podcasts.show', ['podcast' => $podcast]);
    }

    public function edit(string $id)
    {
        $podcast = Podcast::findOrFail($id);
        $statuses = Statuse::all();
        $categories = Category::where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();

        return view('podcasts.edit', ['podcast' => $podcast, 'statuses' => $statuses, 'categories' => $categories, 'tags' => $tags]);
    }

    public function update(Request $request, string $id)
    {
        $podcast = Podcast::findOrFail($id);

        $validated = $request->validate([
            'title' => ['bail', 'required', 'min:5','max:255', Rule::unique(Podcast::class)->ignore(app('request')->segment(2))],
            'content' => 'required|string|min:10',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'statues_id' => 'integer',
            'visibility' => 'integer',
            'category_id' => 'required|integer',
            'featured' => 'integer',
            'tags' => 'array'
        ]);
        $podcast->user_id = $request->user()->id;

        if ($request->hasFile('podcast')) {
            $path = $request->file('podcast')->store('podcasts');


            if ($podcast->path) {
                Storage::delete($podcast->path);
                $validated['path'] = $path;
            } else {
                $validated['path'] = $path;
            }
        }

        $podcast->fill($validated);
        $podcast->save();

        if ($request->has('tags')) {
            $podcast->tags()->sync($request->tags);
        }

        return redirect()->route('podcasts.show', ['podcast' => $podcast->id])
            ->with('success', 'The blog podcast was updated successfully');
    }

    public function destroy(string $id)
    {
        $podcast = Podcast::findOrFail($id);

        if($podcast) {
            $podcast->delete();
            $podcast->comments()->delete();
            return response()->json([
                'status' => 200,
                'message' => 'The blog podcast was deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Blog podcast Found.'
            ]);
        }
//        $post->delete();
//        return redirect()->route('posts.index')
//            ->with('success', 'The blog post was deleted successfully');
    }
}
