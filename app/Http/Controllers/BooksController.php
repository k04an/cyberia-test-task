<?php

namespace App\Http\Controllers;

use App\Enums\EditionEnum;
use App\Models\Author;
use App\Models\Genre;
use App\Services\BooksService;
use Carbon\Traits\Converter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Models\Book;

class BooksController extends Controller
{
    public function create(Request $request, BooksService $booksService) {
        $createdBook = $booksService->createBook($request);
        Log::info("Book with id ".$createdBook->id." has been created by ".auth()->user()->username);
        return redirect(route('books'))->with('success', 'Книга успешно создана');
    }

    public function delete($id, BooksService $booksService) {
        $booksService->deleteBook($id);
        Log::info("Book with id ".$id." has been deleted by ".auth()->user()->username);
        return redirect(route('books'))->with('success', 'Книга успешно удалена');
    }

    public function update(Request $request, $id, BooksService $booksService) {
        $booksService->updateBook($request, $id);
        Log::info("Book with id ".$id." has been updated by ".auth()->user()->username);
        return redirect(route('books'))->with('success', 'Книга успешно обновлена');
    }

    public function index(Request $request, BooksService $booksService) {
        $booksList = $booksService->indexBooksWithFilters($request);

        return view('book/index', [
            'books' => $booksList,
            'authors' => Author::all(),
            'genres' => Genre::all(),
            'filter' => $request->isFilterApplied ? $request : false,
            'navCategory' => 'books'
        ]);
    }
}
