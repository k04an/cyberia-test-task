<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authors\GetAuthorsRequest;
use App\Http\Requests\Api\Authors\PutAuthorRequest;
use App\Services\Api\AuthorsService;

class AuthorController extends Controller
{
    public function index(GetAuthorsRequest $request, AuthorsService $authorsService)
    {
        $pagedList = $authorsService->index($request);

        return [
            'page' => $pagedList['currentPage'],
            'pageNumber' => $pagedList['pageNumber'],
            'data' => $pagedList['data']
        ];
    }

    public function get($id, AuthorsService $authorsService)
    {
        $author = $authorsService->getAuthor($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        return $author;
    }

    public function put(PutAuthorRequest $request, $id, AuthorsService $authorsService)
    {
        $updatedAuthor = $authorsService->updateAuthor($request, $id);

        return $updatedAuthor;
    }
}
