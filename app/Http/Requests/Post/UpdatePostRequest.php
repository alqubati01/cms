<?php

namespace App\Http\Requests\Post;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['bail', 'required', 'min:5','max:255', Rule::unique(Post::class)->ignore(app('request')->segment(2))],
            'short_description' => 'nullable|string',
            'content' => 'required|string|min:10',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'statues_id' => 'integer',
            'visibility' => 'integer',
            'category_id' => 'required|integer',
            'featured' => 'integer',
            'tags' => 'array',
            'file' => 'image|mimes:jpg,jpeg,png,gif,svg,webp|max:1024'
        ];
    }
}
