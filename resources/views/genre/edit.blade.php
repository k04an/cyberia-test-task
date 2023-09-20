@extends('layout.main')

@section('headtext')
    Изменить жанр - {{ $genre->name }}
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Не удалось изменить жанр</div>
    @endif
    <form action="" method="post">
        @csrf
        <x-forms.input placeholder="Название жанра" name="name" value="{{ $genre->name }}"/>
        <x-forms.submit text="Изменить" />
    </form>
@endsection
