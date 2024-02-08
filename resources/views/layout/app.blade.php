@include('partials.header')
<!--header section start -->
<div class="header_section">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="logo"><a href="{{ route('landing-page') }}"><img src="{{ asset('img/logo.png') }}"></a></div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('landing-page') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sofwares">Our Software</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li> --}}
            </ul>
        </div>
    </nav>
    <div class="banner_main">
        <h1 class="banner_taital">Build Best</h1>
        <h1 class="banner_taital_1">Software</h1>
        <p class="banner_text">Build best Software with <a href="{{ route('landing-page') }}">SamariCode</a></p>
        <div class="btn_main">
            <div class="more_bt"><a class="btn" href="https://wa.me/082253332802" target="__blank">Have Question?</a></div>
            {{-- <div class="contact_bt"><a href="#">Get a quote</a></div> --}}
        </div>
    </div>
</div>
<!--header section end -->
<!--costume header section start -->
@include('partials.navbar')
<!--costume header section end -->
@yield('app')
<!--footer section start -->
<div class="footer_section layout_padding" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="footer_logo"><img src="{{ asset('img/logo3.png') }}" class="w-25 border-white"></div>
                <p class="dolor_text">We have any Services</p>
            </div>
            <div class="col-6">
                <h4 class="address_text">Address</h4>
                <p class="dolor_text">Kota Samarinda, Kalimantan Timur.</p>
                <p class="dolor_text"><a href="https://wa.me/082253332802" target="__blank" class="text-white">(+62) 822-5333-2802</a></p>
                <p class="dolor_text">satriai418@gmail.com</p>
            </div>
        </div>
        <div class="social_icon">
            <ul>
                <li><a href="https://www.linkedin.com/in/satriai418/"><img src="asset_landing/images/linkedin-icon.png"></a></li>
                <li><a href="https://www.facebook.com/satriai0805/"><img src="asset_landing/images/fb-icon.png"></a></li>
                <li><a href="https://www.instagram.com/satriairawan05_/"><img src="asset_landing/images/instagram-icon.png"></a></li>
            </ul>
        </div>
    </div>
</div>
<!--footer section end -->
<!-- copyright section start -->
@include('partials.copyright')
<!-- copyright section end -->
@include('partials.footer')
