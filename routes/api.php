<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'apiLogin']);

Route::get('/books', [\App\Http\Controllers\Api\BooksController::class, 'index']);
Route::prefix('/book')->group(function () {
    Route::get('/{id}', [\App\Http\Controllers\Api\BooksController::class, 'get']);
    Route::delete('/{id}', [\App\Http\Controllers\Api\BooksController::class, 'delete'])->middleware('auth:sanctum');
    Route::put('/{id}', [\App\Http\Controllers\Api\BooksController::class, 'put'])->middleware('auth:sanctum');
});

Route::get('/authors', [\App\Http\Controllers\Api\AuthorController::class, 'index']);
Route::prefix('/author')->group(function () {
    Route::get('/{id}', [\App\Http\Controllers\Api\AuthorController::class, 'get']);
    Route::put('/{id}', [\App\Http\Controllers\Api\AuthorController::class, 'put'])->middleware('auth:sanctum');
});

Route::get('/genres', [\App\Http\Controllers\Api\GenresController::class, 'index']);
