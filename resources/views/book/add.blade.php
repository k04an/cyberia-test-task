<html>
<head>
    <title>ELib - Admin dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
<div class="container-fluid">
    <div class="row h-100">
        {{--Side menu--}}
        <div class="col-3 h-100 bg-primary px-3 py-5 text- position-relative">
            <div class="row">
                <h1 class="text-center"><span class="text-white-50">E</span>Lib</h1>
                <h3 class="text-center">Панель управления</h3>
                <hr class="my-4">
            </div>

            <div class="row">
                <ul class="list-group text-center">
                    <li class="list-group-item">
                        <a href="{{ route('genres') }}" class="text-decoration-none text-dark fs-5">Жанры</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('authors') }}" class="text-decoration-none text-dark fs-5">Авторы</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('books') }}" class="text-decoration-none text-dark fs-5">Книги</a>
                        <div class="py-3 text-start ps-4">
                            <a href="{{ route('authors-add') }}" class="text-decoration-none text-primary" style="font-size: 12px">Добавить книгу</a>
                        </div>
                    </li>
                </ul>
            </div>
            <a href="{{ route('logout') }}" class="position-absolute end-0 bottom-0 me-4 mb-3 btn btn-light">Выход</a>
        </div>

        {{--Main area--}}
        <div class="col-9 h-100 p-5">
            <h1 class="text-center">Добавить книгу</h1>
            <hr class="my-4">
            @if ($errors->any())
                <div class="alert alert-danger">Не удалось добавить книгу</div>
            @endif
            <form action="" method="post">
                @csrf
                {{--Выбор имени--}}
                <input type="text" placeholder="Название" name="name" class="form-control w-50 mb-3">

                {{--Выбор автора--}}
                <select class="form-select w-50 mb-3" name="author">
                    <option value="">Автор</option>
                    @foreach($authors as $author)
                        <option value="{{ $author['id'] }}">{{ $author['second_name'] }} {{ $author['first_name'] }}</option>
                    @endforeach
                </select>

                {{--Выбор издания--}}
                <div class="mb-3 w-50">
                        <p>Тип издания:</p>
                        <div class="form-check">
                            <input name="edition" value="{{ \App\Enums\EditionEnum::Graphical->value }}" type="radio" class="form-check-input" id="graphical-edition">
                            <label for="graphical-edition">Графическое</label>
                        </div>
                        <div class="form-check">
                            <input name="edition" value="{{ \App\Enums\EditionEnum::Printed->value }}" type="radio" class="form-check-input" id="printed-edition">
                            <label for="printed-edition">Печатное</label>
                        </div>
                        <div class="form-check">
                            <input name="edition" value="{{ \App\Enums\EditionEnum::Digital->value }}" type="radio" class="form-check-input" id="digital-edition">
                            <label for="digital-edition">Электронное</label>
                        </div>
                </div>
                <hr class="w-50">

                {{--Выбор жанра--}}
                <p>Жанры:</p>
                <div class="mb-3 overflow-y-scroll w-50 h-25">
                    @foreach($genres as $genre)
                        <div class="form-check">
                            <input name="genres[]" type="checkbox" class="form-check-input" value="{{ $genre->id }}" id="genre-{{ $genre->id }}">
                            <label for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
