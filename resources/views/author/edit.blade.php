@extends('layout.main')

@section('headtext')
    Изменить запись автора - {{ $author->first_name }} {{ $author->second_name }}
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Не удалось изменить запись автора</div>
    @endif
    <form action="" method="post">
        @csrf
        <input type="text" placeholder="Имя" name="first_name" class="form-control w-50 mb-3" value="{{ $author->first_name }}">
        <input type="text" placeholder="Фамилия" name="second_name" class="form-control w-50 mb-3" value="{{ $author->second_name }}">
        <hr class="w-50">
        <p>Данные аутентификации для REST API:</p>
        <input type="text" placeholder="Логин" name="login" class="form-control w-50 mb-3" value="{{ $author->login }}">
        <input type="text" placeholder="Пароль" name="password" class="form-control w-50 mb-3">
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
@endsection
