@extends('dashboard.layouts.app')
@section('title'){{ config('app.name') . ' - ' . Str::title($routeIndex) }}@endsection
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <div class="card">
            <div class="card-body bg-light">
                <h5 class="card-title">Selamat Datang, {{Auth::user()->name}}</h5>
                <p>Mini POS Majoo yang dibuat dengan cinta oleh abdan syakuro</p>
            </div>
        </div>
    </main>
@endsection