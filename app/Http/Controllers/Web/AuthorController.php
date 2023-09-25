<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Authors\PostAuthorRequest;
use App\Http\Requests\Web\Authors\PutAuthorRequest;
use App\Services\Web\AuthorsService;

class AuthorController extends Controller
{
    public function create(PostAuthorRequest $request, AuthorsService $authorsService) {
        $authorsService->createAuthor($request);

        return redirect(route('authors'))->with('success', 'Автор успешно создан');
    }

    public function delete($id, AuthorsService $authorsService) {
        $authorsService->deleteAuthor($id);

        return redirect(route('authors'))->with('success', 'Автор успешно удален');
    }

    public function update(PutAuthorRequest $request, $id, AuthorsService $authorsService) {
        $authorsService->updateAuthor($request, $id);

        return redirect(route('authors'))->with('success', 'Автор успешно обновлен');
    }

    public function index(AuthorsService $authorsService) {
        return view('author/index', [
            'context' => $authorsService->indexAuthorsWithBooks(),
            'navCategory' => 'authors'
        ]);
    }
}
