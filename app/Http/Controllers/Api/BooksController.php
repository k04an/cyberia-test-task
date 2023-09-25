<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Books\PutBookRequest;
use App\Services\Api\BooksService;
use Illuminate\Support\Facades\Log;

class BooksController extends Controller
{
    public function index(\App\Http\Requests\Api\Books\GetBooksRequest $request, BooksService $booksService) {
        $pagedList = $booksService->index($request);

        return [
            'page' => $pagedList['currentPage'],
            'pageNumber' => $pagedList['pageNumber'],
            'data' =>$pagedList['data']
        ];
    }

    public function get($id, BooksService $booksService) {
        $book = $booksService->getBooks($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        return $book;
    }

    public function delete($id, BooksService $booksService) {
        $status = $booksService->deleteBook($id);

        if ($status !== true) {
            return $status;
        } else {
            Log::info("Book with id ".$id." has been deleted by author ".auth('sanctum')->user()->login);
            return response()->json([
                'message' => "Ok"
            ], 200);
        }
    }

    public function put(PutBookRequest $request, $id, BooksService $booksService) {
        $updatedBook = $booksService->updateBook($request, $id);

        Log::info("Book with id ".$id." has been updated by author ".auth('sanctum')->user()->login);

        return $updatedBook;
    }
}
