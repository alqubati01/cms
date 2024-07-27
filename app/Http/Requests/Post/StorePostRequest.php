<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'bail|required|unique:posts,title|min:5|max:100',
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
