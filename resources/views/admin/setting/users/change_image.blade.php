@extends('admin.layouts.app')

@section('breadcrumb')
    <header class="page-header">
        <h2>{{ $name }}</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ route('home') }}">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><a href="{{ route('user.index') }}" class="text-decoration-none">{{ $name . 's' }}</a></li>
                <li><span>Change Password</span></li>
            </ol>
            <div class="sidebar-right-toggle">
            </div>
        </div>
    </header>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.image', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <img id="preview-image" class="img-fluid img-thumbnail bg-dark d-none"
                                        alt="Preview Image">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input type="file"
                                        class="form-control form-control-sm @error('image')
                                    is-invalid
                                @enderror"
                                        id="image" placeholder="Masukan Image" value="{{ old('image') }}"
                                        name="image" required>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $errors->get('image')[0] }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-info mx-2"><i
                                            class="fa fa-reply-all"></i></a>
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Ketika input file berubah
            $('#image').change(function() {
                // Mengambil file yang dipilih
                var file = $(this)[0].files[0];

                // Membaca file sebagai URL data
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Menampilkan gambar di elemen dengan ID 'preview-image'
                    $('#preview-image').attr('src', e.target.result);

                    // Menghapus kelas 'd-none' untuk menampilkan gambar
                    $('#preview-image').removeClass('d-none');
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
