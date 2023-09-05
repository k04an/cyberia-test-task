<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenresResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function index(Request $request) {
        $pageNumber = ceil(Genre::all()->count() / 2);

        $validated = $request->validate([
            'page' => 'required|numeric|min:1|max:'.$pageNumber
        ]);

        return [
            'page' => $validated['page'],
            'pageNumber' => $pageNumber,
            'data' => GenresResource::collection(Genre::with('books')->offset(2 * ($validated['page'] - 1))->take(2)->get())
        ];
    }
}
