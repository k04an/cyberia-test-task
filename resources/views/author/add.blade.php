@extends('layout.main')

@section('headtext')
    Добавить автора
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Не удалось добавить автора</div>
    @endif
    <form action="" method="post">
        @csrf
        <x-forms.input placeholder="Имя" name="first_name" />
        <x-forms.input placeholder="Фамилия" name="second_name" />
        <hr class="w-50">
        <p>Данные аутентификации для REST API:</p>
        <x-forms.input placeholder="Логин" name="login" />
        <x-forms.input placeholder="Пароль" name="password" />
        <x-forms.submit text="Создать"/>
    </form>
@endsection
