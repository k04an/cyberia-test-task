@extends('layout.main')

@section('headtext')
    Обновить книгу
@endsection

@section('content')
    @if ($errors->any())
        <x-alert type="error" :text="$errors->first()" />
    @endif
    <form action="" method="post">
        @csrf
        <x-forms.input placeholder="Название" name="name" :value="isset($book) ? $book->name : (old('name') ? old('name') : null)" />

        <x-forms.select.author :authors="$authors" :book="isset($book) ? $book : null" />

        <x-forms.select.edition :book="isset($book) ? $book : null" />

        <hr class="w-50">

        <div class="mb-3 overflow-y-scroll w-50 h-25">
            <x-forms.select.genres :genres="$genres" :book="isset($book) ? $book : null" />
        </div>

        <x-forms.submit text="Сохранить" />
    </form>
@endsection
