<?php

namespace App\Services;

use App\Enums\EditionEnum;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BooksService
{
    public function createBook(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:books',
            'author' => 'required',
            'genres' => 'required|min:1',
            'edition' => 'required'
        ]);

        /* Находим указанного автора */
        $author = Author::find($validatedData['author']);

        if (!$author) {
            return Redirect::back()->withErrors('no-author');
        }

        /* Опредеяем тип издания */
        switch ($validatedData['edition']) {
            case "0":
                $edition = EditionEnum::Graphical;
                break;
            case "1":
                $edition = EditionEnum::Digital;
                break;
            case "2":
                $edition = EditionEnum::Printed;
                break;
        }

        /* Создаем книгу автора */
        $newBook = $author->books()->create([
            'name' => $validatedData['name'],
            'edition' => $edition
        ]);

        /* В созданную книгу добавляем указанные жанры */
        foreach ($validatedData['genres'] as $genreId) {
            $genre = Genre::find(intval($genreId)); /* Находим запись жанра по указанному id */

            $newBook->genres()->attach($genre);
        }

        return $newBook;
    }

    public function deleteBook($id)
    {
        Book::where('id', $id)->delete();
    }

    public function updateBook(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:books,name,'.$id,
            'author' => 'required',
            'genres' => 'required|min:1',
            'edition' => 'required'
        ]);

        $author = Author::find(intval($validated['author']));

        $book = Book::find($id);

        if (!$author or !$book) {
            return Redirect::back()->withErrors('err');
        }

        $book->author_id = $author->id;
        $book->name = $validated['name'];
        $book->edition = $validated['edition'];
        $book->save();

        $book->genres()->sync(array_map('intval', $request->get('genres')));
    }

    public function indexBooksWithFilters(Request $request)
    {
        /* Если задана строка поиска */
        if ($request->isFilterApplied) {
            $booksQuery = Book::query();

            /* Фильтрация по жанрам */
            if ($request->genres) {
                $booksQuery = $booksQuery->whereHas('genres', function ($q) use ($request) {
                    $q->whereIn('genre_id', array_map('intval', $request->genres));
                });
            }

            /* Фильтрация по автору */
            if ($request->author) {
                $booksQuery = $booksQuery->where('author_id', intval($request->author));
            }

            /* Поиск по названию */
            if ($request->search) {
                $booksQuery = $booksQuery->where('name', 'like', '%'.$request->search.'%');
            }

            $books = $booksQuery->get();
        } else {
            $books = Book::all();
        }

        switch ($request->sort) {
            case "asc":
                $books = $books->sortBy('name');
                break;

            case "desc":
                $books = $books->sortByDesc('name');
                break;
        }

        return $books;
    }
}
