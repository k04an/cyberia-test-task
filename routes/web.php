<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Логика аутентификации
Route::middleware('auth')->get('/', function () { return view('dashboard'); })->name('home');
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect(route('home'));
    }
    return view('login');
})->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth')->get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Операции над жанрами
Route::middleware('auth')->prefix('/genres')->group(function () {
    Route::get('/', function () {
       return view('genre/index', [
           'genres' => \App\Models\Genre::all()
       ]);
    })->name('genres');

    Route::get('/add', function () {
        return view('genre/add');
    })->name('genres-add');

    Route::post('/add', [\App\Http\Controllers\GenreController::class, 'create']);

    Route::get('/delete/{id}', [\App\Http\Controllers\GenreController::class, 'delete'])->name('genre-delete');

    Route::get('/edit/{id}', function ($id) {
        return view('genre/edit', [
            'genre' => \App\Models\Genre::find($id)
        ]);
    })->name('genre-update');

    Route::post('/edit/{id}', [\App\Http\Controllers\GenreController::class, 'update']);
});

// Операции над авторамми
Route::middleware('auth')->prefix('/authors')->group(function () {
    Route::get('/', [\App\Http\Controllers\AuthorController::class, 'index'])->name('authors');

    Route::get('/add', function () {
        return view('author/add');
    })->name('authors-add');

    Route::post('/add', [\App\Http\Controllers\AuthorController::class, 'create']);

    Route::get('/delete/{id}', [\App\Http\Controllers\AuthorController::class, 'delete'])->name('author-delete');

    Route::get('/edit/{id}', function ($id) {
        return view('author/edit', [
            'author' => \App\Models\Author::find($id)
        ]);
    })->name('author-update');

    Route::post('/edit/{id}', [\App\Http\Controllers\AuthorController::class, 'update']);
});

// Операции над книгами
Route::middleware('auth')->prefix('/books')->group(function () {
    Route::get('/', [\App\Http\Controllers\BooksController::class, 'index'])->name('books');

    Route::get('/add', function () {
        return view('book/add', [
            'authors' => \App\Models\Author::all(),
            'genres' => \App\Models\Genre::all()
        ]);
    })->name('book-add');

    Route::post('/add', [\App\Http\Controllers\BooksController::class, 'create']);

    Route::get('/delete/{id}', [\App\Http\Controllers\BooksController::class, 'delete'])->name('book-delete');

    Route::get('/edit/{id}', function ($id) {
        return view('book/edit', [
            'book' => \App\Models\Book::find($id),
            'authors' => \App\Models\Author::all(),
            'genres' => \App\Models\Genre::all()
        ]);
    })->name('book-update');

    Route::post('/edit/{id}', [\App\Http\Controllers\BooksController::class, 'update']);
});
