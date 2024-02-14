@extends('auth.layouts.app', ['title' => 'Sign In'])

@section('auth')
    <section class="body-sign">
        <div class="center-sign">
            <a href="{{ route('landing-page') }}" class="logo float-start">
                <img src="{{ asset('img/logo.png') }}" height="70" alt="{{ env('APP_NAME') }}" />
            </a>
            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-end">
                    <h2 class="title text-uppercase bg-dark font-weight-bold m-0"><i
                            class="fa fa-user-circle text-6 position-relative top-5 me-1"></i> Sign In</h2>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Failed!</strong> {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('login.store') }}" method="post"
                        onsubmit="btnsubmit.disabled=true; return true;">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <input name="email" type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="Example : budi@gmail.com" value="{{ old('email') }}" autocomplete="email"
                                    autofocus />
                                <span class="input-group-text">
                                    <i class="bx bx-envelope text-4 text-dark"></i>
                                </span>
                                @error('email')
                                    <small class="invalid-feedback" role="alert"><strong>{{ $errors->get('email')[0] }}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="clearfix">
                                <label for="password" class="float-start">Password</label>
                                {{-- <a href="pages-recover-password.html" class="float-end">Lost Password?</a> --}}
                            </div>
                            <div class="input-group">
                                <input name="password" type="password" id="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Enter Password" maxlength="8" />
                                <span class="input-group-text">
                                    <a href="javascript:;" id="togglePassword"><i
                                            class="bx bx-lock text-4 text-dark"></i></a>
                                </span>
                                @error('password')
                                    <small class="invalid-feedback" role="alert"><strong>{{ $errors->get('password')[0] }}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    <input id="RememberMe" name="rememberme" type="checkbox" />
                                    <label for="RememberMe">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-sm-4 text-end">
                                <button type="submit" id="btnsubmit" class="btn btn-dark mt-2">Sign In</button>
                            </div>
                        </div>
                        <span class="line-thru text-uppercase mb-3 mt-3 text-center">
                            <span>or</span>
                        </span>
                        <p class="text-center">Don't have an account yet? <a href="{{ route('register') }}"
                                class="text-dark">Sign Up!</a></p>
                    </form>
                </div>
            </div>
            @include('auth.partials.copyright')
        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('assets/js/auth.js') }}"></script>
@endpush
