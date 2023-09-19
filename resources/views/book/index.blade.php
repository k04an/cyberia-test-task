@extends('layout.main')

@section('headtext')
    Книги
@endsection

@section('content')
    <form action="" method="get">
        @csrf
        <input type="hidden" name="isFilterApplied" value="1">
        <div class="row mb-3" style="height: 190px">
            <div class="col h-100">
                <span>Поиск по названию:</span>
                <input  @if ($filter) value="{{ $filter->search }}" @endif
                name="search" type="text" placeholder="Название книги" class="form-control">
                <span>Фильтрация по автору:</span>
                <select name="author" class="form-select">
                    <option value="">Нет</option>
                    @foreach($authors as $author)
                        <option @if($filter and $author->id == $filter->author) selected @endif
                        value="{{ $author->id }}">{{ $author->first_name }} {{ $author->second_name }}</option>
                    @endforeach
                </select>
                <span>Сортировка по названию:</span>
                <select name="sort" class="form-select">
                    <option value="">Нет</option>
                    <option value="asc">В прямом порядке (По алфавиту)</option>
                    <option value="desc">В обратном порядке</option>
                </select>
            </div>
            <div class="col h-100">
                <p>Фильтрация по жанрам:</p>
                <div class="overflow-y-scroll h-100">
                    @foreach($genres as $genre)
                        <div class="form-check">
                            <input  @if($filter and $filter->genres and array_search(strval($genre->id), $filter->genres) !== false) checked @endif
                            name="genres[]" type="checkbox" class="form-check-input" id="genre-filter-{{ $genre->id }}" value="{{ $genre->id }}">
                            <label class="form-check-label" id="genre-filter-{{ $genre->id }}">{{ $genre->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary px-5">Поиск</button>
        <a href="{{ route('books') }}" class="btn btn-danger">Очистить фильтр</a>
    </form>
    <hr class="my-4">
    <table class="table">
        <thead>
        <tr>
            <th>#ID</th>
            <th>Название</th>
            <th>Автор</th>
            <th>Жанры</th>
            <th>Дата добавления</th>
            <th>Издание</th>
            <th></th>
        </tr>
        </thead>
        @foreach($books as $book)
            <tr>
                <td>{{ $book['id'] }}</td>
                <td>{{ $book['name'] }}</td>
                <td>{{ $book->author['first_name'] }} {{ $book->author['second_name'] }}</td>
                <td>
                    @foreach($book->genres as $genre)
                        <span class="badge text-bg-primary">{{ $genre->name }}</span>
                    @endforeach
                </td>
                <td>{{ date('d.m.Y', strtotime($book->created_at)) }}</td>
                <td>
                    @switch($book['edition']->value)
                        @case(\App\Enums\EditionEnum::Graphical->value)
                            Графическое
                            @break
                        @case(\App\Enums\EditionEnum::Printed->value)
                            Печатное
                            @break
                        @case(\App\Enums\EditionEnum::Digital->value)
                            Электронное
                            @break
                    @endswitch
                </td>
                <th class="text-end">
                    <a href="{{ route('book-update', [$book['id']]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                        </svg>
                    </a>
                    <a href="{{ route('book-delete', [$book['id']]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                        </svg>
                    </a>
                </th>
            </tr>
        @endforeach
    </table>
@endsection
