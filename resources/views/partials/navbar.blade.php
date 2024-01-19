<div class="costume_header">
    <div class="container">
        <div class="menu_main">
            <ul>
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('landing-page') }}" class="{{ Request::is('/') ? 'text-dark' : '' }}">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#softwares">Our Software</a></li>
                <li><a href="#services">Services</a></li>
            </ul>
        </div>
        <div class="menu_main_1">
            <ul>
                <li><a href="{{ route('login') }}">Sign In</a></li>
                {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
            </ul>
        </div>
    </div>
</div>
