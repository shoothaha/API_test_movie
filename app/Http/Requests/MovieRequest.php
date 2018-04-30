<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'genre' => 'required|string|max:100',
            'release_date' => 'required|date',
            'director' => 'required|string|max:255',
            'running_time' => 'required|numeric|min:30|max:180',
            'rating' => 'required|numeric|max:5'
        ];
    }
}
