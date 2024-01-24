@extends('admin.layouts.app')

@section('breadcrumb')
    <header class="page-header">
        <h2>{{ $name . 's' }}</h2>
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
                    <form action="{{ route('user.password', $user->id) }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <div id="showHidePassword" class="input-group">
                                        <input type="password"
                                            class="form-control form-control-sm @error('password')
                                    is-invalid
                                @enderror"
                                            id="password" placeholder="Masukan Password" value="{{ old('password') }}"
                                            name="password" required autocomplete="new-password">
                                        <span class="input-group-text">
                                            <a href="javascript:;" id="togglePassword"><i
                                                    class="bx bx-lock text-4 text-dark"></i></a>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $errors->get('password')[0] }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="password-confirm">Confirm Password <span
                                            class="text-danger">*</span></label>
                                    <div id="showHidePassword" class="input-group">
                                        <input type="password"
                                            class="form-control form-control-sm @error('password')
                                    is-invalid
                                @enderror"
                                            id="password-confirm" placeholder="Masukan Password"
                                            value="{{ old('password') }}" name="password_confirmation" required
                                            autocomplete="new-password">
                                        <span class="input-group-text">
                                            <a href="javascript:;" id="togglePasswordConfirm"><i
                                                    class="bx bx-lock text-4 text-dark"></i></a>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $errors->get('password')[0] }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-info mx-2"><i
                                            class="fa fa-reply-all"></i></a>
                                    <button type="submit" id="btnsubmit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.css') }}">
    <style type="text/css">
        #showHidePassword {
            position: relative;
        }

        #togglePassword,
        #togglePasswordConfirm {
            position: absolute;
            top: 50%;
            right: 6px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/vendor/select2/js/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/auth.js') }}"></script>
@endpush
