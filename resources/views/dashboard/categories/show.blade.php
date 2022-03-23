@extends('dashboard.layouts.app')
@section('title'){{ config('app.name') . ' - ' . Str::title($routeIndex) }}@endsection
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route($routeIndex)}}">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Kategori</li>
              </ol>
        </nav>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3>Detail Kategori</h3>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="rounded rounded-lg p-4 bg-light">
                    <div class="row pb-2">
                        <div class="col-5">Nama Kategori</div>
                        <div class="col-7">: {{$detail->name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-5">Waktu Dibuat</div>
                        <div class="col-7">: {{$detail->created_at->format('d-m-Y')}}</div>
                    </div>
                    <div class="text-end mt-4">
                        <a href="{{ route($routeIndex) }}" class="btn btn-secondary me-2" type="button">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection