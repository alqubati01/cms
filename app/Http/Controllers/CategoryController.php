<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $categories = Category::withCount('posts')->filter()->latest()->paginate(10);
        $data = $request->all();

        return view('categories.index', ['categories' => $categories, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50|unique:categories,name',
            'status' => 'integer',
            'short_description' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        } else {
            $category = new Category();
            $category->name = $request->input('name');
            $category->is_active = $request->input('status');
            $category->short_description = $request->input('short_description');
            $category->meta_title = $request->input('meta_title');
            $category->meta_description = $request->input('meta_description');
            $category->save();
            return response()->json([
                'status'=> 200,
                'message'=> 'Category Added Successfully.'
            ]);
        }
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        if($category) {
            return response()->json([
                'status' => 200,
                'category' => $category,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Category Found.'
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3','max:50', Rule::unique(Category::class)->ignore(app('request')->segment(2))],
            'status' => 'integer',
            'short_description' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        } else {
            $category = Category::findOrFail($id);
            if ($category) {
                $category->name = $request->input('name');
                $category->is_active = $request->input('status');
                $category->short_description = $request->input('short_description');
                $category->meta_title = $request->input('meta_title');
                $category->meta_description = $request->input('meta_description');
                $category->update();
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Category Updated Successfully.'
                ]);
            } else {
                return response()->json([
                    'status'=> 404,
                    'errors'=> 'No Category Found'
                ]);
            }
        }
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if($category) {
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Category Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Category Found.'
            ]);
        }
    }
}
