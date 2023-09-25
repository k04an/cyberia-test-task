<?php

namespace App\Http\Requests\Api\Genres;

use App\Models\Genre;
use Illuminate\Foundation\Http\FormRequest;

class GetGenresRequest extends FormRequest
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
        $pageNumber = ceil(Genre::all()->count() / 2);

        return [
            'page' => 'required|numeric|min:1|max:'.$pageNumber
        ];
    }
}
