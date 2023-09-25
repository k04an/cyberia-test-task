<?php

namespace App\Services\Api;

use App\Http\Requests\Api\Genres\GetGenresRequest;
use App\Http\Resources\GenresResource;
use App\Models\Genre;

class GenresService
{
    public function index(GetGenresRequest $request)
    {
        $validated = $request->validated();
        $pageNumber = ceil(Genre::all()->count() / 2);

        return [
            'data' => GenresResource::collection(Genre::with('books')->offset(2 * ($validated['page'] - 1))->take(2)->get()),
            'currentPage' => $validated['page'],
            'pageNumber' => $pageNumber
        ];
    }
}
