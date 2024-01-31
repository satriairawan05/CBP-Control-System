@php
    $pages = \App\Models\User::leftJoin('group_pages', 'users.group_id', '=', 'group_pages.group_id')
        ->leftJoin('groups', 'users.group_id', '=', 'groups.group_id')
        ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
        ->where('group_pages.access', '=', 1)
        ->where('group_pages.group_id', '=', (int) auth()->user()->group_id)
        ->select(['group_pages.access', 'pages.page_name', 'pages.action'])
        ->get();

    $contract = 0;
    $project = 0;
    $task = 0;
    $report = 0;
    $payment = 0;
    $user = 0;

    foreach ($pages as $r) {
        if ($r->page_name == 'Contract') {
            if ($r->action == 'Read') {
                $contract = $r->access;
            }
        }

        if ($r->page_name == 'Project') {
            if ($r->action == 'Read') {
                $project = $r->access;
            }
        }

        if ($r->page_name == 'Task') {
            if ($r->action == 'Read') {
                $task = $r->access;
            }
        }

        if ($r->page_name == 'Report') {
            if ($r->action == 'Read') {
                $report = $r->access;
            }
        }

        if ($r->page_name == 'Payment') {
            if ($r->action == 'Read') {
                $payment = $r->access;
            }
        }

        if ($r->page_name == 'User') {
            if ($r->action == 'Read') {
                $user = $r->access;
            }
        }
    }
@endphp

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
                    @if ($contract == 1)
                        <li class="{{ Request::is('contract*') ? 'nav-active' : '' }}">
                            <a class="nav-link" href="{{ route('contract.index') }}">
                                <i class="fa fa-file" aria-hidden="true"></i>
                                <span>Contracts</span>
                            </a>
                        </li>
                    @endif
                    @if ($project == 1)
                        <li class="{{ Request::is('project*') ? 'nav-active' : '' }}">
                            <a class="nav-link" href="{{ route('project.index') }}">
                                {{-- <span class="float-end badge badge-danger">182</span> --}}
                                <i class="fa fa-file-contract" aria-hidden="true"></i>
                                <span>Projects</span>
                            </a>
                        </li>
                    @endif
                    @if ($task == 1)
                        <li class="{{ Request::is('task*') ? 'nav-active' : '' }}">
                            <a class="nav-link" href="{{ route('task.index') }}">
                                <i class="fa fa-file-lines" aria-hidden="true"></i>
                                <span>Tasks</span>
                            </a>
                        </li>
                    @endif
                    @if ($report == 1)
                        <li class="{{ Request::is('report*') ? 'nav-active' : '' }}">
                            <a class="nav-link" href="{{ route('report.index') }}">
                                <i class="fa fa-file-code" aria-hidden="true"></i>
                                <span>Reports</span>
                            </a>
                        </li>
                    @endif
                    @if ($payment == 1)
                        <li>
                            <a class="nav-link" href="#">
                                <i class="fa fa-file-invoice-dollar" aria-hidden="true"></i>
                                <span>Payments</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a class="nav-link" href="#">
                            <i class="fa fa-user-check" aria-hidden="true"></i>
                            <span>Approval</span>
                        </a>
                    </li>
                    @if ($user == 1)
                        <li class="{{ Request::is('user*') ? 'nav-active' : '' }}">
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <i class="fa fa-users-cog" aria-hidden="true"></i>
                                <span>Users</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->group_id == 1)
                        <li class="{{ Request::is('role*') ? 'nav-active' : '' }}">
                            <a class="nav-link" href="{{ route('role.index') }}">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                <span>Roles</span>
                            </a>
                        </li>
                    @endif
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
