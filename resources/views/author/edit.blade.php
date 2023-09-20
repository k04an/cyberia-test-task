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
        <x-forms.input placeholder="Имя" name="first_name" value="{{ $author->first_name }}" />
        <x-forms.input placeholder="Фамилия" name="second_name" value="{{ $author->second_name }}" />
        <hr class="w-50">
        <p>Данные аутентификации для REST API:</p>
        <x-forms.input placeholder="Логин" name="login" value="{{ $author->login }}" />
        <x-forms.input placeholder="Пароль" name="password" />
        <x-forms.submit text="Изменить"/>
    </form>
@endsection
