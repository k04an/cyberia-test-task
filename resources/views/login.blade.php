<html>
    <head>
        <title>ELib - Login page</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    </head>

    <body>
        <div class="container-fluid h-100 d-flex justify-content-center align-items-center">
            <div class="col-4">
                <div class="card p-4 shadow">
                    <h3 class="card-title text-center mb-0">Admin login</h3>
                    <hr>
                    @if ($errors->any())
                        <x-alert type="error" :text="$errors->first()" />
                    @endif
                    <form action="" method="post">
                        @csrf
                        <x-forms.input :value="old('username') ? old('username') : null"
                            name="username" placeholder="Имя пользователя" />
                        <x-forms.input name="password" placeholder="Пароль" type="password" />
                        <x-forms.submit text="Войти"  style="w-100"/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
