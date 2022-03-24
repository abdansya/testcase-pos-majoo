@extends('dashboard.layouts.app')
@section('title'){{ config('app.name') . ' - ' . Str::title($routeIndex) }}@endsection
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route($routeIndex)}}">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
              </ol>
        </nav>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3>Semua Produk</h3>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{route($routeIndex.'.create')}}" class="btn btn-brand">Tambah Produk</a>
            </div>
        </div>
        <div class="table-responsive-md">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($list))
                        @foreach ($list as $key => $item)
                            <tr>
                                <td class="align-middle">{{ $key + $list->firstItem() }}</td>
                                <td class="align-middle">{{ $item->name }}</td>
                                <td class="align-middle">{{ $item->category->name ?? '-' }}</td>
                                <td class="align-middle">Rp. {{ number_format($item->price,0) }}</td>
                                <td class="text-center">
                                    <a href="{{ route($routeIndex.'.show', $item->id) }}" class="btn btn-outline-success btn-sm m-1" title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path fill="none" d="M0 0h24v24H0z"/><path d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"/></svg>
                                    </a>
                                    <a href="{{ route($routeIndex.'.edit', $item->id) }}" class="btn btn-outline-info btn-sm m-1" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path fill="none" d="M0 0h24v24H0z"/><path d="M15.728 9.686l-1.414-1.414L5 17.586V19h1.414l9.314-9.314zm1.414-1.414l1.414-1.414-1.414-1.414-1.414 1.414 1.414 1.414zM7.242 21H3v-4.243L16.435 3.322a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414L7.243 21z"/></svg>
                                    </a>
                                    <form action="{{ route($routeIndex.'.destroy', $item->id) }}" method="post" class="d-inline" onclick="remove(this)">
                                        @csrf @method('delete')
                                        <button type="button" class="btn btn-outline-danger btn-sm m-1" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 8h16v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8zm2 2v10h12V10H6zm3 2h2v6H9v-6zm4 0h2v6h-2v-6zM7 5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v2h5v2H2V5h5zm2-1v1h6V4H9z"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if(count($list))
            <div class="row my-4">
                <div class="col mt-2">
                    Menampilkan {{ $list->firstItem() }} sampai {{ $list->lastItem() }} dari {{ $list->total() }} entri
                </div>
                <div class="col">
                    {{ $list->links() }}
                </div>
            </div>
        @endif
    </main>
@endsection