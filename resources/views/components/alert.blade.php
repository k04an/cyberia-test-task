<div class="alert
    @switch($type)
        @case('success')
            alert-success
        @break

        @case('error')
            alert-danger
        @break
    @endswitch">
    {{ $text }}
</div>
