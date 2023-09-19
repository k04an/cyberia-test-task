<html>
@include('layout.header')

<body>
<div class="container-fluid">
    <div class="row h-100">
        {{--Side menu--}}
        @include('layout.navigation', ["category" => $navCategory])

        {{--Main area--}}
        <div class="col-9 h-100 p-5 overflow-y-scroll">
            <h1 class="text-center">@yield('headtext')</h1>
            <hr class="my-4">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
