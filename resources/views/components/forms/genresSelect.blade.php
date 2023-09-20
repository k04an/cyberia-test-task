@foreach($genres as $genre)
    <div class="form-check">
        <input  @if(isset($filter) and $filter and $filter->genres and array_search(strval($genre->id), $filter->genres) !== false) checked @endif
            @if (isset($book) and $book->genres()->find($genre->id)) checked @endif
            name="genres[]" type="checkbox" class="form-check-input" id="genre-filter-{{ $genre->id }}" value="{{ $genre->id }}">
        <label class="form-check-label" id="genre-filter-{{ $genre->id }}">{{ $genre->name }}</label>
    </div>
@endforeach
