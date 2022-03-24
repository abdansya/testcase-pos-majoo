@extends('dashboard.layouts.app')
@section('title'){{ config('app.name') . ' - ' . Str::title($routeIndex) }}@endsection
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route($routeIndex)}}">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
              </ol>
        </nav>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3>Tambah Produk</h3>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="rounded rounded-lg p-4 bg-light">
                    <form method="POST" action="{{ route($routeIndex . '.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-3 border p-2" style="max-width: 640px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img id="imageThumbnail" src="{{old('image') ?? asset('images/no-image.jpeg')}}" class="img-thumbnail rounded" alt="Photo" width="200px" height="200px">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body py-2">
                                        <h5 class="card-title">Gambar Produk</h5>
                                        <input id="inputImage" class="upload-image" type="file" name="upload_image" accept="image/*" hidden>
                                        <input type="hidden" name="image" id="imageValue" value="{{old('image')}}">
                                        <button style="{{old('image') ? 'display: none;' : ''}}" class="btn btn-outline-brand mt-5" id="btnUpload" type="button" onclick="document.getElementById('inputImage').click()">
                                            Unggah Gambar
                                        </button>
                                        <div style="{{old('image') ? '' : 'display: none;'}}" class="label-group">
                                            <p id="imageLabel">&nbsp;</p>
                                            <button class="btn btn-outline-warning" id="btnChange" type="button">
                                                Ubah Gambar
                                            </button>
                                        </div>
                                        <div class="form-text text-info">*ukuran 500px 500px, max. 1Mb</div>
                                        <div class="progress" id="progressBar" style="display: none;">
                                            <div class="progress-bar" id="barValue" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                        </div>
                                        @error('image')
                                            <div class="form-text text-danger">*{{$message}}</div>
                                        @enderror
                                        <div class="form-text text-danger" id="errorUploadImage" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') {{'is-invalid'}} @enderror" id="inputName" aria-describedby="name" name="name" value="{{old('name')}}" placeholder="Nama Produk">
                            @error('name')
                                <div class="form-text text-danger">*{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="inputPrice" class="form-label">Harga</label>
                            <input type="number" class="form-control @error('price') {{'is-invalid'}} @enderror" id="inputPrice" aria-describedby="price" name="price" value="{{old('price')}}" placeholder="Harga Produk">
                            @error('price')
                                <div class="form-text text-danger">*{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="selectCategory" class="form-label">Kategori</label>
                            <select id="selectCategory" class="form-select @error('category_id') {{'is-invalid'}} @enderror" name="category_id" data-placeholder="Pilih Kategori">
                                <option></option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                              </select>
                            @error('category_id')
                                <div class="form-text text-danger">*{{$message}}</div>
                            @enderror
                            @if ($categories->count() == 0)
                                <div class="form-text text-info">*Mohon tambahkan kategori dahulu pada data master</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="inputDescription" class="form-label">Deskripsi</label>
                            <textarea id="inputDescription" class="form-control @error('description') {{'is-invalid'}} @enderror" name="description" placeholder="Deskripsi Produk" rows="15">{{old('description')}}</textarea>
                            @error('description')
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

@section('extraJs')
    <script src="https://cdn.tiny.cloud/1/5165lbgmgv8hnllly89ic08fhdcygdu52f47kb2t1wrsrisi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function() {
            $('.form-select').select2({
                theme: 'bootstrap-5',
                placeholder: $( this ).data( 'placeholder' ),
            });
            tinymce.init({
                selector: '#inputDescription',
                menubar:false,
                plugins: 'lists',
                toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent'
            });


            /** Upload image with progress bar **/
            $('#btnChange').click(function(){
                $('#btnUpload').show();
                $('.label-group').hide();
                $('#imageThumbnail').attr('src','/images/no-image.jpeg');
                $('#imageValue').val('');
            });

            $('#inputImage').change(function () {
                let file = $('#inputImage').prop('files')[0];
                let formData = new FormData();
                let urlUpload = "{{route($routeIndex.'.uploadimage')}}"

                let containerBar = $('#progressBar');
                let bar = $('#barValue');

                formData.append('image', file);
                formData.append('_token', "{{csrf_token()}}");
  
                $.ajax({
                    type: 'POST',
                    url: urlUpload,
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        containerBar.show();
                        bar.css('width', '0%');
                    },
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(event) {
                            if (event.lengthComputable) {
                                let percentComplete = (event.loaded / event.total) * 100;
                                let percentVal = percentComplete + '%';
                                bar.css('width', percentVal);
                                bar.html(percentVal);
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        let percentVal = '100%';
                        bar.css('width', percentVal);
                        bar.html(percentVal);
                        $('#imageThumbnail').attr("src", response.data.path);
                        $('#progressBar').delay(1000).hide(100);
                        $('#btnUpload').hide();
                        $('.label-group').show();
                        $('#imageLabel').html(response.data.name);
                        $('#imageValue').val(response.data.path);
                        $('#errorUploadImage').hide();
                    },
                    error: function (response) {
                        $('#progressBar').hide();
                        $('#errorUploadImage').show();
                        $('#errorUploadImage').html('*'+response.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endsection