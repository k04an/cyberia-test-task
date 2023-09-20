<div class="mb-3 w-50">
    <p>Тип издания:</p>
    <div class="form-check">
        <input  @if(isset($book) and $book->edition->value == \App\Enums\EditionEnum::Graphical->value) checked @endif
            @if (old('edition') !== false and old('edition') === \App\Enums\EditionEnum::Graphical->value) checked @endif
            name="edition" value="{{ \App\Enums\EditionEnum::Graphical->value }}"
            type="radio" class="form-check-input" id="graphical-edition">
        <label for="graphical-edition">Графическое</label>
    </div>
    <div class="form-check">
        <input  @if(isset($book) and $book->edition->value == \App\Enums\EditionEnum::Printed->value) checked @endif
            @if (old('edition') !== false and old('edition') === \App\Enums\EditionEnum::Printed->value) checked @endif
            name="edition" value="{{ \App\Enums\EditionEnum::Printed->value }}"
            type="radio" class="form-check-input" id="printed-edition">
        <label for="printed-edition">Печатное</label>
    </div>
    <div class="form-check">
        <input  @if(isset($book) and $book->edition->value == \App\Enums\EditionEnum::Digital->value) checked @endif
            @if (old('edition') !== false and old('edition') === \App\Enums\EditionEnum::Digital->value) checked @endif
            name="edition" value="{{ \App\Enums\EditionEnum::Digital->value }}"
            type="radio" class="form-check-input" id="digital-edition">
        <label for="digital-edition">Электронное</label>
    </div>
</div>
