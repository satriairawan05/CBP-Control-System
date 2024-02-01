<!doctype html>
<html class="fixed">
<!-- Mirrored from www.okler.net/previews/porto-admin/4.1.0/pages-500.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Jan 2024 06:20:31 GMT -->

<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <meta name="keywords" content="SamariCode Project" />
    <meta name="description" content="SamariCode Project by Deuwi Satriya Irawan">
    <meta name="author" content="Deuwi Satriya Irawan">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"
        type="text/css">
    <!-- Vendor CSS -->
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/gif" />
    <title>{{ env('APP_NAME') }} || @yield('title')</title>
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.compat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
    <!-- Specific Page Vendor CSS -->

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}" />
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- Head Libs -->
    <script src="{{ asset('assets/vendor/modernizr/modernizr.js') }}"></script>
    <script src="{{ asset('assets/master/style-switcher/style.switcher.localstorage.js') }}"></script>
</head>

<body>
    <!-- start: page -->
    <section class="body-error error-outside">
        <div class="center-error">
            <div class="row">
                <div class="col-md-8">
                    <div class="main-error mb-3">
                        <h2 class="error-code text-dark font-weight-semibold m-0 text-center">@yield('code') <i
                                class="fas fa-file"></i></h2>
                        <p class="error-explanation text-center">@yield('message')</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4 class="text">Here are some useful links</h4>
                    <ul class="nav nav-list flex-column primary">
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}"><i
                                        class="fas fa-caret-right text-dark"></i>
                                    Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('landing-page') }}"><i
                                        class="fas fa-caret-right text-dark"></i>
                                    Landing Page</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- end: page -->
    <!-- Vendor -->
    <script src="{{ asset('assets/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/master/style-switcher/style.switcher.js') }}"></script>
    <script src="{{ asset('assets/vendor/popper/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/common/common.js') }}"></script>
    <script src="{{ asset('assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
    <!-- Specific Page Vendor -->
    <!-- Theme Base, Components and Settings -->
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <!-- Theme Custom -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- Theme Initialization Files -->
    <script src="{{ asset('assets/js/theme.init.js') }}"></script>
</body>

<!-- Mirrored from www.okler.net/previews/porto-admin/4.1.0/pages-500.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Jan 2024 06:20:31 GMT -->

</html>
