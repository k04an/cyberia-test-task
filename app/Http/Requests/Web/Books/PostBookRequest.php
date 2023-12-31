<?php

namespace App\Http\Requests\Web\Books;

use Illuminate\Foundation\Http\FormRequest;

class PostBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:books',
            'author' => 'required',
            'genres' => 'required|min:1',
            'edition' => 'required'
        ];
    }
}
