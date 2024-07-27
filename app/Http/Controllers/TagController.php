<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tags = Tag::withCount('posts')->filter()->latest()->paginate(10);
        $data = $request->all();

        return view('tags.index', ['tags' => $tags, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|unique:tags,name',
            'status' => 'integer',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        } else {
            $tag = new Tag();
            $tag->name = $request->input('name');
            $tag->is_active = $request->input('status');
            $tag->meta_title = $request->input('meta_title');
            $tag->meta_description = $request->input('meta_description');
            $tag->save();
            return response()->json([
                'status'=> 200,
                'message'=> 'Tag Added Successfully.'
            ]);
        }
    }

    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);

        if($tag) {
            return response()->json([
                'status' => 200,
                'tag' => $tag,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Tag Found.'
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3','max:50', Rule::unique(Tag::class)->ignore(app('request')->segment(2))],
            'status' => 'integer',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        } else {
            $tag = Tag::findOrFail($id);
            if ($tag) {
                $tag->name = $request->input('name');
                $tag->is_active = $request->input('status');
                $tag->meta_title = $request->input('meta_title');
                $tag->meta_description = $request->input('meta_description');
                $tag->update();
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Tag Updated Successfully.'
                ]);
            } else {
                return response()->json([
                    'status'=> 404,
                    'errors'=> 'No Tag Found'
                ]);
            }
        }
    }

    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);

        if($tag) {
            $tag->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Tag Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Tag Found.'
            ]);
        }
    }
}
