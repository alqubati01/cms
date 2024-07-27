<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string',
            'username' => ['required', 'string', Rule::unique(User::class)->ignore(app('request')->segment(2))],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore(app('request')->segment(2))],
            'role' => 'required|integer',
            'file' => 'image|mimes:jpg,jpeg,png,gif,svg,webp|max:1024'
        ];
    }
}
