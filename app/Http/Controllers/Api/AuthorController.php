<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorsResource;
use App\Models\Author;
use App\Services\Api\AuthorsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    public function index(Request $request, AuthorsService $authorsService) {
        $pagedList = $authorsService->index($request);

        return [
            'page' => $pagedList['currentPage'],
            'pageNumber' => $pagedList['pageNumber'],
            'data' => $pagedList['data']
        ];
    }

    public function get($id, AuthorsService $authorsService) {
        $author = $authorsService->getAuthor($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        return $author;
    }

    public function put(Request $request, $id, AuthorsService $authorsService) {
        $updatedAuthor = $authorsService->updateAuthor($request, $id);

        return $updatedAuthor;
    }
}
