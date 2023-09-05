<html>
<head>
    <title>ELib - Admin dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
<div class="container-fluid">
    <div class="row h-100">
        {{--Side menu--}}
        <div class="col-3 h-100 bg-primary px-3 py-5 text-white position-relative">
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
                        <div class="py-3 text-start ps-4">
                            <a href="{{ route('authors-add') }}" class="text-decoration-none text-primary" style="font-size: 12px">Добавить автора</a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('books') }}" class="text-decoration-none text-dark fs-5">Книги</a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('logout') }}" class="position-absolute end-0 bottom-0 me-4 mb-3 btn btn-light">Выход</a>
        </div>

        {{--Main area--}}
        <div class="col-9 h-100 p-5">
            <h1 class="text-center">Добавить автора</h1>
            <hr class="my-4">
            @if ($errors->any())
                <div class="alert alert-danger">Не удалось добавить автора</div>
            @endif
            <form action="" method="post">
                @csrf
                <input type="text" placeholder="Имя" name="first_name" class="form-control w-50 mb-3">
                <input type="text" placeholder="Фамилия" name="second_name" class="form-control w-50 mb-3">
                <hr class="w-50">
                <p>Данные аутентификации для REST API:</p>
                <input type="text" placeholder="Логин" name="login" class="form-control w-50 mb-3">
                <input type="text" placeholder="Пароль" name="password" class="form-control w-50 mb-3">
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
