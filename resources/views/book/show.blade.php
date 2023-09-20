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
        <x-forms.input placeholder="Название" name="name" :value="isset($book) ? $book->name : null" />

        <x-forms.authorSelect :authors="$authors" :book="isset($book) ? $book : null" />

        <x-forms.editionSelect :book="isset($book) ? $book : null" />

        <hr class="w-50">

        <div class="mb-3 overflow-y-scroll w-50 h-25">
            <x-forms.genresSelect :genres="$genres" :book="isset($book) ? $book : null" />
        </div>

        <x-forms.submit text="Сохранить" />
    </form>
@endsection
