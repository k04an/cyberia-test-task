<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Genres\GetGenresRequest;
use App\Services\Api\GenresService;

class GenreController extends Controller
{
    public function index(GetGenresRequest $request, GenresService $genresService)
    {
        $pagedList = $genresService->index($request);

        return [
            'page' => $pagedList['currentPage'],
            'pageNumber' => $pagedList['pageNumber'],
            'data' => $pagedList['data']
        ];
    }
}
