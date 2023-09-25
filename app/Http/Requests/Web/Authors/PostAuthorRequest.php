<?php

namespace App\Http\Requests\Web\Authors;

use Illuminate\Foundation\Http\FormRequest;

class PostAuthorRequest extends FormRequest
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
            'first_name' => 'required',
            'second_name' => 'required',
            'login' => 'required|unique:authors',
            'password' => 'required'
        ];
    }
}
