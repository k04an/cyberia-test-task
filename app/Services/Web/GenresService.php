<?php

namespace App\Services\Web;

use App\Http\Requests\Web\Genres\PostPutGenreRequest;
use App\Models\Genre;
use Illuminate\Support\Facades\Redirect;

class GenresService
{
    public function createGenre(PostPutGenreRequest $request)
    {
        $validatedData = $request->validated();

        Genre::create([
            'name' => $validatedData['name']
        ]);
    }

    public function deleteGenre($id)
    {
        Genre::where('id', $id)->delete();
    }

    public function updateGenre(PostPutGenreRequest $request, $id)
    {
        $validated = $request->validated();

        $genre = Genre::find($id);

        if (!$genre) {
            return Redirect::back()->withErrors('updateError');
        }

        $genre->name = $validated['name'];
        $genre->save();
    }
}
