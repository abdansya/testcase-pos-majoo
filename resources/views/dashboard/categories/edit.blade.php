@extends('dashboard.layouts.app')
@section('title'){{ config('app.name') . ' - ' . Str::title($routeIndex) }}@endsection
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route($routeIndex)}}">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kategori</li>
              </ol>
        </nav>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3>Edit Kategori</h3>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="rounded rounded-lg p-4 bg-light">
                    <form method="POST" action="{{ route($routeIndex . '.update', $detail->id) }}" enctype="multipart/form-data">
                        @csrf @method('put')
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('name') {{'is-invalid'}} @enderror" id="inputName" aria-describedby="name" name="name" value="{{old('name', $detail->name)}}">
                            @error('name')
                                <div class="form-text text-danger">*{{$message}}</div>
                            @enderror
                        </div>
                        <div class="text-end mt-4">
                            <a href="{{ route($routeIndex) }}" class="btn btn-secondary me-2" type="button">Batal</a>
                            <button class="btn btn-brand" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection