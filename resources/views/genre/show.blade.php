@extends('layout.main')

@section('headtext')
    {{ $title }}
@endsection

@section('content')
    @if ($errors->any())
        <x-alert type="error" :text="$errors->first()" />
    @endif
    <form action="" method="post">
        @csrf
        <x-forms.input placeholder="Название жанра" name="name" :value="isset($genre) ? $genre->name : (old('name') ? old('name') : null)" />
        <x-forms.submit text="Сохранить" />
    </form>
@endsection
