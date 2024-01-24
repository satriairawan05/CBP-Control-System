@include('admin.partials.header')


@php
    $role = \App\Models\Group::where('group_id',auth()->user()->group_id)->first();
@endphp

<section class="body">
    <!-- start: header -->
    <header class="header">
        <div class="logo-container">
            <a href="{{ route('home') }}" class="logo"> <img src="{{ asset('img/logo.png') }}" width="50"
                    height="40" alt="{{ env('APP_NAME') }}" />
            </a>
            <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
                data-fire-event="sidebar-left-opened">
                <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>
        <!-- start: search & user box -->
        <div class="header-right">
            <span class="separator"></span>
            <ul class="notifications">
                <li class="d-inline-block align-top">
                    <i class="fa fa-clock d-flex justify-content-center"></i>
                    <p id="time"></p>
                </li>
            </ul>
            <span class="separator"></span>
            <div id="userbox" class="userbox">
                <a href="#" data-bs-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="{{ asset('img/profile.png') }}" alt="{{ auth()->user()->name }}"
                            class="rounded-circle @if (auth()->user()->image == null) bg-dark @endif"
                            data-lock-picture="{{ asset('img/profile.png') }}" />
                    </figure>
                    <div class="profile-info" data-lock-name="{{ auth()->user()->name }}"
                        data-lock-email="{{ auth()->user()->email }}">
                        <span class="name">{{ auth()->user()->name }}</span>
                        <span class="role">{{ $role->group_name }}</span>
                    </div>
                    <i class="fa custom-caret"></i>
                </a>
                <div class="dropdown-menu">
                    <ul class="list-unstyled mb-2">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{ route('user.show',auth()->user()->id) }}"><i class="bx bx-user-check"></i> My
                                Profile</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{ route('user.changepassword',auth()->user()->id) }}"><i class="bx bxs-user-account"></i> Change
                                Password</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post"
                                onsubmit="logout.disabled=true; return true;">
                                @csrf
                                <button role="menuitem" id="logout" tabindex="-1" type="submit" id="logout"
                                    class="btn btn-sm btn-light"><i class="bx bx-power-off"></i>
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    </header>
    <!-- end: header -->
    <div class="inner-wrapper">
        <!-- start: sidebar -->
        @include('admin.partials.sidebar')
        <!-- end: sidebar -->
        <section role="main" class="content-body">
            @yield('breadcrumb')
            <!-- start: page -->
            @yield('app')
            <!-- end: page -->
        </section>
    </div>
</section>
@include('admin.partials.footer')
