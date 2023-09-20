<form action="" method="get">
    @csrf
    <input type="hidden" name="isFilterApplied" value="1">
    <div class="row mb-3" style="height: 210px">
        <div class="col h-100">
            <span>Поиск по названию:</span>
            <x-forms.input :value="$filter ? $filter->search : ''" placeholder="Название книги" name="search"/>

            <span>Фильтрация по автору:</span>
            <x-forms.authorSelect :authors="$authors"  :filter="$filter"/>

            <span>Сортировка по названию:</span>
            <select name="sort" class="form-select">
                <option value="">Нет</option>
                <option value="asc">В прямом порядке (По алфавиту)</option>
                <option value="desc">В обратном порядке</option>
            </select>
        </div>

        <div class="col h-100">
            <p>Фильтрация по жанрам:</p>
            <div class="overflow-y-scroll h-100">
                <x-forms.genresSelect :genres="$genres" :filter="$filter" />
            </div>
        </div>
    </div>

    <x-forms.submit text="Поиск" />
    <a href="{{ route('books') }}" class="btn btn-danger">Очистить фильтр</a>
</form>
