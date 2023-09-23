<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{
    public function create(Request $request, AuthorsService $authorsService) {
        $authorsService->createAuthor($request);

        return redirect(route('authors'))->with('success', 'Автор успешно создан');
    }

    public function delete($id, AuthorsService $authorsService) {
        $authorsService->deleteAuthor($id);

        return redirect(route('authors'))->with('success', 'Автор успешно удален');
    }

    public function update(Request $request, $id, AuthorsService $authorsService) {
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
