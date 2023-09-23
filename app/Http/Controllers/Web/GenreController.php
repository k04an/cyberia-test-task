<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\GenresService;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function create(Request $request, GenresService $genresService) {
        $genresService->createGenre($request);

        return redirect(route('genres'))->with('success', 'Жанр успешно создан');
    }

    public function delete($id, GenresService $genresService) {
        $genresService->deleteGenre($id);

        return redirect(route('genres'))->with('success', 'Жанр успешно удален');
    }

    public function update(Request $request, $id, GenresService $genresService) {
        $genresService->updateGenre($request, $id);

        return redirect(route('genres'))->with('success', 'Жанр успешно обновлен');
    }
}
