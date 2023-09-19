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
        <input type="text" placeholder="Название жанра" name="name" class="form-control w-50 mb-3" value="{{ $genre->name }}">
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
@endsection
