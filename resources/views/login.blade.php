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
                    @error('msg')
                        <div class="alert alert-danger">Login failed. Check your username/password again.</div>
                    @enderror
                    <form action="" method="post">
                        @csrf
                        <input name="username" type="text" placeholder="Username" class="form-control mb-4">
                        <input name="password" type="password" placeholder="Password" class="form-control mb-4">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
