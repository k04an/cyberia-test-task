<?php

namespace App\Services\Web;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GenresService
{
    public function createGenre(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:genres'
        ]);

        Genre::create([
            'name' => $validatedData['name']
        ]);
    }

    public function deleteGenre($id)
    {
        Genre::where('id', $id)->delete();
    }

    public function updateGenre(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $genre = Genre::find($id);

        if (!$genre) {
            return Redirect::back()->withErrors('updateError');
        }

        $genre->name = $validated['name'];
        $genre->save();
    }
}
