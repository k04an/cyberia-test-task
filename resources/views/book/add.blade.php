@extends('layout.main')

@section('headtext')
    Добавить книгу
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Не удалось добавить книгу</div>
    @endif
    <form action="" method="post">
        @csrf
        <x-forms.input placeholder="Название" name="name" />

        <x-forms.authorSelect :authors="$authors" />

        <x-forms.editionSelect />

        <hr class="w-50">

        <p>Жанры:</p>
        <div class="mb-3 overflow-y-scroll w-50 h-25">
            <x-forms.genresSelect :genres="$genres" />
        </div>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
