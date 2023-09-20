<select class="form-select mb-3" name="author">
    <option value="">Автор</option>
    @foreach($authors as $author)
        <option @if (isset($filter) and $filter and $author->id == $filter->author) selected @endif
            @if (isset($book) and $book->author->id == $author['id']) selected @endif
            value="{{ $author['id'] }}">{{ $author['second_name'] }} {{ $author['first_name'] }}</option>
    @endforeach
</select>
