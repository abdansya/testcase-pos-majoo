<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name', 'POS Majoo'))</title>
        <meta name="description" content="@yield('description', config('app.name', 'POS Majoo'))">
        
        <!-- Bootstrap 5.1 -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Extra Style CSS -->
        @yield('extraCss')
    </head>
    <body>
        {{-- Header Navbar --}}
        @include('dashboard.layouts.includes.header')

        <div class="container-fluid">
            <div class="row">
                {{-- Sidebar Menu --}}
                @include('dashboard.layouts.includes.sidebar')

                @yield('content')
            </div>
        </div>

        {{-- Jquery3.6.0 --}}
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        {{-- Bootstrap 5.1 --}}
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        {{-- Sweet Alert2 --}}
        <script src="{{asset('js/sweetalert2.min.js')}}"></script>
        {{-- Custom JS --}}
        <script src="{{asset('js/custom.js')}}"></script>
        {{-- Sweet Alert Realrashid --}}
        @include('sweetalert::alert')
    </body>
</html>
