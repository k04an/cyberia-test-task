<?php

namespace App\Services\Web;

use App\Http\Requests\Web\Authors\PostAuthorRequest;
use App\Http\Requests\Web\Authors\PutAuthorRequest;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthorsService
{
    public function createAuthor(PostAuthorRequest $request)
    {
        $validatedData = $request->validated();

        Author::create([
            'first_name' => $validatedData['first_name'],
            'second_name' => $validatedData['second_name'],
            'login' => $validatedData['login'],
            'password' => Hash::make($validatedData['password'])
        ]);
    }

    public function deleteAuthor($id)
    {
        Author::where('id', $id)->delete();
    }

    public function updateAuthor(PutAuthorRequest $request, $id)
    {
        $validated = $request->validated();

        $author = Author::find($id);

        if (!$author) {
            return Redirect::back()->withErrors('updateError');
        }

        $author->makeVisible('password');
        $author->first_name = $validated['first_name'];
        $author->second_name = $validated['second_name'];
        $author->login = $validated['login'];
        $author->password = Hash::make($validated['password']);
        $author->save();

        /* После изменения данных пользователя отзываем все токены */
        foreach ($author->tokens as $token) {
            $token->delete();
        }
    }

    public function indexAuthorsWithBooks()
    {
        $authors = Author::all();
        $context = array();
        foreach ($authors as $author) {
            array_push($context, [
                'author' => $author,
                'books' => $author->books->count()
            ]);
        }

        return $context;
    }
}
