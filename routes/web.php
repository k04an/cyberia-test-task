<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth')->get('/', function () { return view('dashboard', ['navCategory' => 'none']); })->name('home');
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
           'genres' => \App\Models\Genre::all(),
           'navCategory' => 'genres'
       ]);
    })->name('genres');

    Route::get('/add', function () {
        return view('genre/show', [
            'navCategory' => 'genres',
            'title' => 'Добавить жанр'
        ]);
    })->name('genres-add');

    Route::post('/add', [\App\Http\Controllers\Web\GenreController::class, 'create']);

    Route::get('/delete/{id}', [\App\Http\Controllers\Web\GenreController::class, 'delete'])->name('genre-delete');

    Route::get('/edit/{id}', function ($id) {
        return view('genre/show', [
            'genre' => \App\Models\Genre::find($id),
            'navCategory' => 'genres',
            'title' => 'Изменить жанр'
        ]);
    })->name('genre-update');

    Route::post('/edit/{id}', [\App\Http\Controllers\Web\GenreController::class, 'update']);
});

// Операции над авторамми
Route::middleware('auth')->prefix('/authors')->group(function () {
    Route::get('/', [\App\Http\Controllers\Web\AuthorController::class, 'index'])->name('authors');

    Route::get('/add', function () {
        return view('author/show', [
            'navCategory' => 'authors',
            'title' => 'Добавить автора'
        ]);
    })->name('authors-add');

    Route::post('/add', [\App\Http\Controllers\Web\AuthorController::class, 'create']);

    Route::get('/delete/{id}', [\App\Http\Controllers\Web\AuthorController::class, 'delete'])->name('author-delete');

    Route::get('/edit/{id}', function ($id) {
        return view('author/show', [
            'author' => \App\Models\Author::find($id),
            'navCategory' => 'authors',
            'title' => 'Изменить запись автора'
        ]);
    })->name('author-update');

    Route::post('/edit/{id}', [\App\Http\Controllers\Web\AuthorController::class, 'update']);
});

// Операции над книгами
Route::middleware('auth')->prefix('/books')->group(function () {
    Route::get('/', [\App\Http\Controllers\Web\BookController::class, 'index'])->name('books');

    Route::get('/add', function () {
        return view('book/show', [
            'authors' => \App\Models\Author::all(),
            'genres' => \App\Models\Genre::all(),
            'navCategory' => 'books',
            'title' => 'Создать книгу'
        ]);
    })->name('book-add');

    Route::post('/add', [\App\Http\Controllers\Web\BookController::class, 'create']);

    Route::get('/delete/{id}', [\App\Http\Controllers\Web\BookController::class, 'delete'])->name('book-delete');

    Route::get('/edit/{id}', function ($id) {
        return view('book/show', [
            'book' => \App\Models\Book::find($id),
            'authors' => \App\Models\Author::all(),
            'genres' => \App\Models\Genre::all(),
            'navCategory' => 'books',
            'title' => 'Обновить запись книги'
        ]);
    })->name('book-update');

    Route::post('/edit/{id}', [\App\Http\Controllers\Web\BookController::class, 'update']);
});
