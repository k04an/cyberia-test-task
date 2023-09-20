@extends('layout.main')

@section('headtext')
    Добавить жанр
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Не удалось добавить жанр</div>
    @endif
    <form action="" method="post">
        @csrf
        <x-forms.input placeholder="Название жанра" name="name"/>
        <x-forms.submit text="Создать" />
    </form>
@endsection
