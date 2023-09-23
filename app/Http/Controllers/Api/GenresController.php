<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenresResource;
use App\Models\Genre;
use App\Services\Api\GenresService;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function index(Request $request, GenresService $genresService) {
        $pagedList = $genresService->index($request);

        return [
            'page' => $pagedList['currentPage'],
            'pageNumber' => $pagedList['pageNumber'],
            'data' => $pagedList['data']
        ];
    }
}
