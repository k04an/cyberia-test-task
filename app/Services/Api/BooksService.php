<?php

namespace App\Services\Api;

use App\Http\Resources\BooksResource;
use App\Models\Book;

class BooksService
{
    public function index(\App\Http\Requests\Api\Books\GetBooksRequest $request)
    {
        $pageNumber = ceil(Book::all()->count() / 10);

        $validated = $request->validated();

        return [
            'currentPage' => $validated['page'],
            'pageNumber' => $pageNumber,
            'data' => BooksResource::collection(Book::with('author')->offset(10 * ($validated['page'] - 1))->take(10)->get())
        ];
    }

    public function getBooks($id)
    {
        return Book::with('author')->find($id);
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        if ($book->author_id != auth('sanctum')->user()->id) {
            return response()->json([
                'message' => 'You are not the author of this book'
            ], 401);
        }

        $book->delete();

        return true;
    }

    public function updateBook(\App\Http\Requests\Api\Books\PutBookRequest $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        if ($book->author_id != auth('sanctum')->user()->id) {
            return response()->json([
                'message' => 'You are not the author of this book'
            ], 401);
        }

        $validated = $request->validated();

        $book->name = $validated['name'];
        $book->edition = intval($validated['edition']);
        $book->save();
        $book->genres()->sync($validated['genres']);

        return $book;
    }
}
