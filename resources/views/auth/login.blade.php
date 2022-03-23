<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Signin Template · Bootstrap v5.1</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <style>
            body {
                margin: 0;
                padding: 0;
                background-color: #edf6e1;
                height: 100vh;
            }
            #login {
                background-color: #ffffff;
                margin-top: 100px;
            }
        </style>
    </head>
    <body>
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 rounded p-5" id="login">
                        <div class="text-center">
                            <img src="{{asset('images/majoo.png')}}" class="img-fluid" alt="...">
                        </div>
                        <form class="mt-5" action="{{route('login')}}" method="post">
                            @csrf
                            <h1 class="h3 mb-3 fw-normal">Login Dashboard</h1>
                            <div class="form-group mb-2">
                                <label for="email">Email:</label><br>
                                <input type="text" name="email" id="email" class="form-control">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
