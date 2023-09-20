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
        <x-forms.input placeholder="Название" name="name" value="{{ $book->name }}" />

        <x-forms.authorSelect :authors="$authors" :book="$book" />

        <x-forms.editionSelect :book="$book" />
        <hr class="w-50">

        <div class="mb-3 overflow-y-scroll w-50 h-25">
            <x-forms.genresSelect :genres="$genres" :book="$book" />
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection
