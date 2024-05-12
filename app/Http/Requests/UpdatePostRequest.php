<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_category_id' => 'required|exists:post_categories,id',
            'author_id' => 'required|exists:authors,id',
            'title' => 'required',
            'slug' => 'required',
            'intro' => 'required',
            'overview' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif',
        ];
    }
}
