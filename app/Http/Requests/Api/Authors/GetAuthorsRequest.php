<?php

namespace App\Http\Requests\Api\Authors;

use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;

class GetAuthorsRequest extends FormRequest
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
        $pageNumber = ceil(Author::all()->count() / 10);

        return [
            'page' => 'required|numeric|min:1|max:'.$pageNumber
        ];
    }
}
