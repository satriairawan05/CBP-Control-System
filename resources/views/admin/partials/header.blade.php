<!doctype html>
<html class="fixed">

<!-- Mirrored from www.okler.net/previews/porto-admin/4.1.0/layouts-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Jan 2024 06:18:28 GMT -->

<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }} || Dashboard</title>
    <meta name="keywords" content="SamariCode Project" />
    <meta name="description" content="SamariCode Project by Deuwi Satriya Irawan">
    <meta name="author" content="Deuwi Satriya Irawan">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('img/logo-white.png') }}" type="image/gif" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"
        type="text/css">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.compat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
    <!-- Specific Page Vendor CSS -->
    @stack('css')
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}" />
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- Head Libs -->
    <script src="{{ asset('assets/vendor/modernizr/modernizr.js') }}"></script>
    <script src="{{ asset('assets/master/style-switcher/style.switcher.localstorage.js') }}"></script>
</head>

<body>
