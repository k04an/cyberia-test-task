<?php

namespace App\Http\Requests\Api\Books;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PutBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('books')->ignore($this->route('id'))
            ],
            'edition' => 'required|in:1,2,3',
            'genres' => 'required|array|exists:genres,id'
        ];
    }
}
