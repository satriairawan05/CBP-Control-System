<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html"
            data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class="{{ Request::is('home') ? 'nav-active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fa fa-home-alt" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <i class="fa fa-file" aria-hidden="true"></i>
                            <span>Contracts</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('project*') ? 'nav-active' : '' }}">
                        <a class="nav-link" href="{{ route('project.index') }}">
                            {{-- <span class="float-end badge badge-danger">182</span> --}}
                            <i class="fa fa-file-contract" aria-hidden="true"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('task*') ? 'nav-active' : '' }}">
                        <a class="nav-link" href="{{ route('task.index') }}">
                            <i class="fa fa-file-lines" aria-hidden="true"></i>
                            <span>Tasks</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <i class="fa fa-file-code" aria-hidden="true"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <i class="fa fa-file-invoice-dollar" aria-hidden="true"></i>
                            <span>Payments</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#">
                            <i class="fa fa-user-check" aria-hidden="true"></i>
                            <span>Approval</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user*') ? 'nav-active' : '' }}">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="fa fa-users-cog" aria-hidden="true"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('role*') ? 'nav-active' : '' }}">
                        <a class="nav-link" href="{{ route('role.index') }}">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <span>Roles</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>
    </div>
</aside>
