<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Genre;
use App\Services\Web\BooksService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
