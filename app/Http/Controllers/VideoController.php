<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Statuse;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $videos = Video::withCount('comments')->with('user', 'statues', 'category')->filter()->orderBy('id')->paginate(10);
        $data = $request->all();
        $statuses = Statuse::all();
        $categories = Category::all();

        return view('videos.index', ['videos' => $videos, 'data' => $data, 'statuses' => $statuses, 'categories' => $categories]);
    }

    public function create()
    {
        $statuses = Statuse::all();
        $categories = Category::where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();

        return view('videos.create', ['statuses' => $statuses, 'categories' => $categories, 'tags' => $tags]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'bail|required|unique:videos,title|min:5|max:100',
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

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos');
            $validated['path'] = $path;
        }

        $video = Video::create($validated);

        if ($request->has('tags')) {
            $video->tags()->sync($request->tags);
        }

        return redirect()->route('videos.show', ['video' => $video->id])
            ->with('success', 'The blog video was created successfully');
    }

    public function show(string $id)
    {
        $video = Video::with('user', 'statues', 'category', 'comments', 'comments.user', 'comments.statues')->findOrFail($id);

        return view('videos.show', ['video' => $video]);
    }

    public function edit(string $id)
    {
        $video = Video::findOrFail($id);
        $statuses = Statuse::all();
        $categories = Category::where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();

        return view('videos.edit', ['video' => $video, 'statuses' => $statuses, 'categories' => $categories, 'tags' => $tags]);
    }

    public function update(Request $request, string $id)
    {
        $video = Video::findOrFail($id);

        $validated = $request->validate([
            'title' => ['bail', 'required', 'min:5','max:255', Rule::unique(Video::class)->ignore(app('request')->segment(2))],
            'content' => 'required|string|min:10',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'statues_id' => 'integer',
            'visibility' => 'integer',
            'category_id' => 'required|integer',
            'featured' => 'integer',
            'tags' => 'array'
        ]);
        $video->user_id = $request->user()->id;

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos');


            if ($video->path) {
                Storage::delete($video->path);
                $validated['path'] = $path;
            } else {
                $validated['path'] = $path;
            }
        }

        $video->fill($validated);
        $video->save();

        if ($request->has('tags')) {
            $video->tags()->sync($request->tags);
        }

        return redirect()->route('videos.show', ['video' => $video->id])
            ->with('success', 'The blog video was updated successfully');
    }

    public function destroy(string $id)
    {
        $video = Video::findOrFail($id);

        if($video) {
            $video->delete();
            $video->comments()->delete();
            return response()->json([
                'status' => 200,
                'message' => 'The blog video was deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Blog video Found.'
            ]);
        }
//        $post->delete();
//        return redirect()->route('posts.index')
//            ->with('success', 'The blog post was deleted successfully');
    }
}
