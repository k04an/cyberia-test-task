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
                            <a href="{{ route('authors') }}" class="text-decoration-none text-primary fs-5">Авторы</a>
                            <div class="py-3 text-start ps-4">
                                <a href="{{ route('authors-add') }}" class="text-decoration-none text-dark" style="font-size: 12px">Добавить автора</a>
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
            <div class="col-9 h-100 p-5 overflow-y-scroll">
                <h1 class="text-center">Авторы</h1>
                <hr class="my-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Кол-во книг</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach($context as $author)
                        <tr>
                            <td>{{ $author['author']['id'] }}</td>
                            <td>{{ $author['author']['first_name'] }}</td>
                            <td>{{ $author['author']['second_name'] }}</td>
                            <td>{{ $author['books'] }}</td>
                            <th class="text-end">
                                <a href="{{ route('author-update', [$author['author']['id']]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('author-delete', [$author['author']['id']]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </a>
                            </th>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>
</html>
