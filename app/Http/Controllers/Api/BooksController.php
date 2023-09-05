<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;
use App\Models\Book;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BooksController extends Controller
{
    public function index(Request $request) {
        $pageNumber = ceil(Book::all()->count() / 10);

        $validated = $request->validate([
            'page' => 'required|numeric|min:1|max:'.$pageNumber
        ]);

        return [
            'page' => $validated['page'],
            'pageNumber' => $pageNumber,
            'data' => BooksResource::collection(Book::with('author')->offset(10 * ($validated['page'] - 1))->take(10)->get())
        ];
    }

    public function get($id) {
        $book = Book::with('author')->find($id);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], 404);
        }

        return $book;
    }

    public function delete($id) {
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

        Log::info("Book with id ".$id." has been deleted by author ".auth('sanctum')->user()->login);

        return response()->json([
            'message' => "Ok"
        ], 200);
    }

    public function put(Request $request, $id) {
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

        $validated = $request->validate([
            'name' => 'required|unique:books,name,'.$id,
            'edition' => 'required|in:0,1,2',
            'genres' => 'required|array|exists:genres,id'
        ]);

        $book->name = $validated['name'];
        $book->edition = intval($validated['edition']);
        $book->save();
        $book->genres()->sync($validated['genres']);

        Log::info("Book with id ".$id." has been updated by author ".auth('sanctum')->user()->login);

        return $book;
    }
}
