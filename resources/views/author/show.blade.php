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
        <x-forms.input placeholder="Имя" name="first_name" :value=" isset($author) ? $author->first_name : (old('first_name') ? old('first_name') : null)" />
        <x-forms.input placeholder="Фамилия" name="second_name" :value="isset($author) ? $author->second_name : (old('second_name') ? old('second_name') : null)" />
        <hr class="w-50">
        <p>Данные аутентификации для REST API:</p>
        <x-forms.input placeholder="Логин" name="login" :value="isset($author) ? $author->login : (old('login') ? old('login') : null)" />
        <x-forms.input placeholder="Пароль" name="password" />
        <x-forms.submit text="Изменить"/>
    </form>
@endsection
