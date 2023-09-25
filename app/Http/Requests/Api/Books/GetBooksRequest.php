<?php

namespace App\Http\Requests\Api\Books;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;

class GetBooksRequest extends FormRequest
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
        $pageNumber = ceil(Book::all()->count() / 10);

        return [
            'page' => 'required|numeric|min:1|max:'.$pageNumber
        ];
    }
}
