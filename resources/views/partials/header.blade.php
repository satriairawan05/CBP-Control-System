<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>{{ env('APP_NAME') }}</title>
    <meta name="keywords" content="SamariCode Project">
    <meta name="description" content="SamariCode Project by Deuwi Satriya Irawan">
    <meta name="author" content="Deuwi Satriya Irawan">
    <!-- owl carousel style -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css" />
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset_landing/css/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset_landing/css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('asset_landing/css/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('asset_landing/css/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="{{ asset('asset_landing/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_landing/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <style>
        .costum_header,
        .btn-main,
        .footer_section,
        .btn-dark {
            background-color: #000 !important;
        }

        .banner_taital_1,
        .read_bt,
        .readmore_bt {
            color: #000 !important;
        }

        .subscribe_bt {
            background-color: #000 !important;
        }

        .img-fixed-size {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
