<?php

namespace App\Services\Api;

use App\Http\Resources\GenresResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenresService
{
    public function index(Request $request)
    {
        $pageNumber = ceil(Genre::all()->count() / 2);

        $validated = $request->validate([
            'page' => 'required|numeric|min:1|max:'.$pageNumber
        ]);

        return [
            'data' => GenresResource::collection(Genre::with('books')->offset(2 * ($validated['page'] - 1))->take(2)->get()),
            'currentPage' => $validated['page'],
            'pageNumber' => $pageNumber
        ];
    }
}
