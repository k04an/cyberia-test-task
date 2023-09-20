<?php

namespace App\Http\Controllers;

use App\Enums\EditionEnum;
use App\Models\Author;
use App\Models\Genre;
use Carbon\Traits\Converter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Models\Book;

class BooksController extends Controller
{
    public function create(Request $request) {
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

        Log::info("Book with id ".$newBook->id." has been created by ".auth()->user()->username);

        return redirect(route('books'))->with('success', 'Книга успешно создана');
    }

    public function delete($id) {
        Log::info("Book with id ".$id." has been deleted by ".auth()->user()->username);

        Book::where('id', $id)->delete();

        return redirect(route('books'))->with('success', 'Книга успешно удалена');
    }

    public function update(Request $request, $id) {
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

        Log::info("Book with id ".$id." has been updated by ".auth()->user()->username);

        return redirect(route('books'))->with('success', 'Книга успешно обновлена');
    }

    public function index(Request $request) {
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

        return view('book/index', [
            'books' => $books,
            'authors' => Author::all(),
            'genres' => Genre::all(),
            'filter' => $request->isFilterApplied ? $request : false,
            'navCategory' => 'books'
        ]);
    }
}
