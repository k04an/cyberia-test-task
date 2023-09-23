<?php

namespace App\Services\Api;

use App\Http\Resources\AuthorsResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorsService
{
    public function index(Request $request)
    {
        $pageNumber = ceil(Author::all()->count() / 10);

        $validated = $request->validate([
            'page' => 'required|numeric|min:1|max:'.$pageNumber
        ]);

        return [
            'currentPage' => $validated['page'],
            'pageNumber' => $pageNumber,
            'data' => AuthorsResource::collection(Author::with('books')->offset(10 * ($validated['page'] - 1))->take(10)->get())
        ];
    }

    public function getAuthor($id)
    {
        return Author::with('books.genres')->get();
    }

    public function updateAuthor(Request $request, $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'message' => 'Author not found'
            ], 404);
        }

        if ($author->id != auth('sanctum')->user()->id) {
            return response()->json([
                'message' => 'You can not update other author info'
            ], 401);
        }

        $validated = $request->validate([
            'first_name' => 'required',
            'second_name' => 'required',
            'login' => 'required|unique:authors,login,'.$id,
            'password' => 'required'
        ]);

        $author->first_name = $validated['first_name'];
        $author->second_name = $validated['second_name'];
        $author->login = $validated['login'];
        $author->password = Hash::make($validated['password']);
        $author->save();

        /* При обновленни данных автора отзываем все токены */
        foreach ($author->tokens as $token) {
            $token->delete();
        }

        return $author;
    }
}
