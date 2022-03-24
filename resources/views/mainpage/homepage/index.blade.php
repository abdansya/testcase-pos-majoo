<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="/images/majoo-logo.png">
        <title>@yield('title', config('app.name', 'POS Majoo'))</title>
        <meta name="description" content="@yield('description', config('app.name', 'POS Majoo'))">
        
        <!-- Bootstrap 5.1 -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Select2 4.1 -->
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
        <!-- Select2 Theme Bootstrap 5 -->
        <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
            .bg-brand{
                background-color: #00b7b5;
            }
            /*
            * Button
            */

            .btn-brand {
                color: #fff;
                background-color: #00b7b5;
                border-color: #00b7b5;
            }

            .btn-brand:hover {
                color: #fff;
                background-color: #009693;
                border-color: #009693;
            }
        </style>

    </head>
    <body>
        <header>
            <div class="navbar navbar-dark bg-brand shadow-sm">
                <div class="container">
                    <a href="#" class="navbar-brand d-flex align-items-center">
                        <strong>Majoo Teknologi Indonesia</strong>
                    </a>
                </div>
            </div>
        </header>

        <main class="p-4">
            <h2>Produk</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4 mt-2">
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $product->image ?? asset('images/no-image.jpeg')}}" class="card-img-top" alt="Produk">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{$product->name}}</h5>
                                <div class="text-center mb-3">Rp. {{number_format($product->price,0,',','.')}}</div>
                                <div>
                                    {!!$product->description!!}
                                </div>
                            </div>
                            <div class="card-foote bg-transparentr text-center mb-4 mt-3 px-3 d-grid">
                                <a href="#" class="btn btn-brand">Beli</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 mt-4 border-top bg-light">
            <p class="text-muted">2022 @ PT Majoo Teknologi</p>
        </footer>

        {{-- Jquery3.6.0 --}}
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        {{-- Bootstrap 5.1 --}}
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        {{-- Sweet Alert2 --}}
        <script src="{{asset('js/sweetalert2.min.js')}}"></script>
        {{-- Select2 --}}
        <script src="{{asset('js/select2.min.js')}}"></script>
        {{-- Custom JS --}}
        <script src="{{asset('js/custom.js')}}"></script>
    </body>
</html>
