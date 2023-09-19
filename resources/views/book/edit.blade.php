@extends('layout.main')

@section('headtext')
    Обновить книгу
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Не удалось обновить книгу</div>
    @endif
    <form action="" method="post">
        @csrf
        <input type="text" placeholder="Название" name="name" class="form-control w-50 mb-3" value="{{ $book->name }}">
        <select class="form-select w-50 mb-3" name="author">
            @foreach($authors as $author)
                <option @if($book->author->id == $author['id']) selected @endif
                value="{{ $author['id'] }}">{{ $author['second_name'] }} {{ $author['first_name'] }}</option>
            @endforeach
        </select>

        {{--Выбор издания--}}
        <div class="mb-3 w-50">
            <p>Тип издания:</p>
            <div class="form-check">
                <input  @if($book->edition->value == \App\Enums\EditionEnum::Graphical->value) checked @endif
                name="edition" value="{{ \App\Enums\EditionEnum::Graphical->value }}"
                        type="radio" class="form-check-input" id="graphical-edition">
                <label for="graphical-edition">Графическое</label>
            </div>
            <div class="form-check">
                <input  @if($book->edition->value == \App\Enums\EditionEnum::Printed->value) checked @endif
                name="edition" value="{{ \App\Enums\EditionEnum::Printed->value }}"
                        type="radio" class="form-check-input" id="printed-edition">
                <label for="printed-edition">Печатное</label>
            </div>
            <div class="form-check">
                <input  @if($book->edition->value == \App\Enums\EditionEnum::Digital->value) checked @endif
                name="edition" value="{{ \App\Enums\EditionEnum::Digital->value }}"
                        type="radio" class="form-check-input" id="digital-edition">
                <label for="digital-edition">Электронное</label>
            </div>
        </div>
        <hr class="w-50">

        <div class="mb-3 overflow-y-scroll w-50 h-25">
            @foreach($genres as $genre)
                <div class="form-check">
                    <input  @if ($book->genres()->find($genre->id)) checked @endif
                    name="genres[]" type="checkbox" class="form-check-input"
                            value="{{ $genre->id }}" id="genre-{{ $genre->id }}">
                    <label for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection
