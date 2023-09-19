<div class="col-3 h-100 bg-primary px-3 py-5 text-white position-relative">
    <div class="row">
        <h1 class="text-center"><span class="text-white-50">E</span>Lib</h1>
        <h3 class="text-center">Панель управления</h3>
        <hr class="my-4">
    </div>

    <div class="row">
        <ul class="list-group text-center">
            <li class="list-group-item">
                <a href="{{ route('genres') }}" class="text-decoration-none
                 @if($category == 'genres') text-primary @else text-dark @endif fs-5">Жанры</a>
                @if($category == 'genres')
                    <div class="py-3 text-start ps-4">
                        <a href="{{ route('genres-add') }}" class="text-decoration-none text-dark" style="font-size: 12px">Добавить жанр</a>
                    </div>
                @endif
            </li>
            <li class="list-group-item">
                <a href="{{ route('authors') }}" class="text-decoration-none
                 @if($category == 'authors') text-primary @else text-dark @endif fs-5">Авторы</a>
                @if($category == 'authors')
                    <div class="py-3 text-start ps-4">
                        <a href="{{ route('authors-add') }}" class="text-decoration-none text-dark" style="font-size: 12px">Добавить автора</a>
                    </div>
                @endif
            </li>
            <li class="list-group-item">
                <a href="{{ route('books') }}" class="text-decoration-none
                 @if($category == 'books') text-primary @else text-dark @endif fs-5">Книги</a>
                @if($category == 'books')
                    <div class="py-3 text-start ps-4">
                        <a href="{{ route('book-add') }}" class="text-decoration-none text-dark" style="font-size: 12px">Добавить книгу</a>
                    </div>
                @endif
            </li>
        </ul>
    </div>
    <a href="{{ route('logout') }}" class="position-absolute end-0 bottom-0 me-4 mb-3 btn btn-light">Выход</a>
</div>
