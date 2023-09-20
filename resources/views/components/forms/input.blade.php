<input placeholder="{{ $placeholder  }}" name="{{ $name }}"
       class="form-control mb-3" @if(isset($value)) value="{{ $value }}" @endif
       @if (isset($type)) type="{{ $type }}" @else type="text" @endif >
