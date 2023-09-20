<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GenreController extends Controller
{
    public function create(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:genres'
        ]);

        Genre::create([
            'name' => $validatedData['name']
        ]);

        return redirect(route('genres'))->with('success', 'Жанр успешно создан');
    }

    public function delete($id) {
        Genre::where('id', $id)->delete();

        return redirect(route('genres'))->with('success', 'Жанр успешно удален');
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $genre = Genre::find($id);

        if (!$genre) {
            return Redirect::back()->withErrors('updateError');
        }

        $genre->name = $validated['name'];
        $genre->save();

        return redirect(route('genres'))->with('success', 'Жанр успешно обновлен');
    }
}
