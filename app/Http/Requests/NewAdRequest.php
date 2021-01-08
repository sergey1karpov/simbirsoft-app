<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewAdRequest extends FormRequest
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
            'title' => 'required|min:10|max:255|',
            'description' => 'required|min:10|max:500|',
            'photo' => 'dimensions:min_width=300,min_height=300|file|max:512|mimes:jpg,jpeg,png',
            'photos.*' => 'dimensions:min_width=300,min_height=300|file|max:512|mimes:jpg,jpeg,png',
            'price' => 'required|integer',
        ];
    }
}
