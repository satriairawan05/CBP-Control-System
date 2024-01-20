@extends('auth.layouts.app', ['title' => 'Sign Up'])

@section('auth')
    <section class="body-sign">
        <div class="center-sign">
            <a href="{{ route('landing-page') }}" class="logo float-start">
                <img src="{{ asset('img/logo.png') }}" height="70" alt="{{ env('APP_NAME') }}" />
            </a>
            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-end">
                    <h2 class="title text-uppercase bg-dark font-weight-bold m-0"><i
                            class="fa fa-user-circle text-6 position-relative top-5 me-1"></i> Sign Up</h2>
                </div>
                <div class="card-body">
                    @if (session('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Failed!</strong> {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register.store') }}"
                        onsubmit="btnsubmit.disabled=true; return true;">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <div class="input-group">
                                <input name="name" type="text"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    placeholder="Example : Budi" value="{{ old('name') }}" autofocus />
                                <span class="input-group-text">
                                    <i class="bx bx-user text-4 text-dark"></i>
                                </span>
                                @error('name')
                                    <small class="invalid-feedback"
                                        role="alert"><strong>{{ $errors->get('name')[0] }}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group input-group mb-3">
                            <label>Email</label>
                            <div class="input-group">
                                <input name="email" type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="Example : budi@samaricode.my.id" value="{{ old('email') }}"
                                    autocomplete="email" />
                                <span class="input-group-text">
                                    <i class="bx bx-envelope text-4 text-dark"></i>
                                </span>
                                @error('email')
                                    <small class="invalid-feedback"
                                        role="alert"><strong>{{ $errors->get('email')[0] }}</strong></small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <input name="password" type="password" id="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            placeholder="Enter Password" autocomplete="new-password" maxlength="8" />
                                        <span class="input-group-text">
                                            <a href="javascript:;" id="togglePassword"><i
                                                    class="bx bx-lock text-4 text-dark"></i></a>
                                        </span>
                                        @error('password')
                                            <small
                                                class="invalid-feedback"><strong>{{ $errors->get('password')[0] }}</strong></small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Confirm Password</label>
                                    <div class="input-group">
                                        <input name="password_confirmation" type="password" id="passwordConfirm"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            placeholder="Enter Confirm Password" autocomplete="new-password" maxlength="8" />
                                        <span class="input-group-text">
                                            <a href="javascript:;" id="togglePasswordConfirm"><i
                                                    class="bx bx-lock text-4 text-dark"></i></a>
                                        </span>
                                        @error('password')
                                            <small
                                                class="invalid-feedback"><strong>{{ $errors->get('password')[0] }}</strong></small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    <input id="AgreeTerms" name="agreeterms" type="checkbox" />
                                    <label for="AgreeTerms">I agree with <a href="#" class="text-dark">terms of
                                            use</a></label>
                                </div>
                            </div>
                            <div class="col-sm-4 text-end">
                                <button type="submit" id="btnsubmit" class="btn btn-dark mt-2">Sign Up</button>
                            </div>
                        </div>
                        <span class="line-thru text-uppercase mb-3 mt-3 text-center">
                            <span>or</span>
                        </span>
                        <p class="text-center">Already have an account? <a href="{{ route('login') }}"
                                class="text-dark">Sign In!</a></p>
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
