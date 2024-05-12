<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTourRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required',
            'intro' => 'required',
            'overview' => 'required',
            'max_altitude' => 'required|integer|min:1',
            'departure_city' => 'required',
            'best_season' => 'required',
            'walking_hour' => 'required',
            'wifi' => 'required|boolean',
            'min_age' => 'required|integer|min:1|lt:max_age',
            'max_age' => 'required|integer|min:1|max:100|gt:min_age',
            'quantity' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1',
            'accommodation_id' => 'required|exists:accommodation,id',
            'image' => 'array|nullable',
            'image.*' => 'image|mimes:jpg,jpeg,png,svg,gif'
        ];
    }
}
