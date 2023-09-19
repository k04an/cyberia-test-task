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
        <input type="text" placeholder="Название жанра" name="name" class="form-control w-50 mb-3">
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
