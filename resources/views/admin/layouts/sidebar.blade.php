<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
        {{--        <div class="sidebar-brand-icon rotate-n-15">--}}
        {{--            <i class="fas fa-laugh-wink"></i>--}}
        {{--        </div>--}}
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

{{--    <!-- Divider -->--}}
{{--    <hr class="sidebar-divider">--}}

<!-- Nav Item - Tables -->
    @if (auth()->check() && auth()->user()->hasRole('admin'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Users</span></a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('roles') }}">
            <i class="fas fa-user-tag"></i>
            <span>Roles</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('permissions') }}">
            <i class="fas fa-ban"></i>
            <span>Permissions</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('posts.index') }}">
            <i class="fas fa-fw fa-blog"></i>
            <span>Posts</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tags') }}">
            <i class="fas fa-hashtag"></i>
            <span>Tags</span></a>
    </li>

{{--    <!-- Divider -->--}}
{{--    <hr class="sidebar-divider d-none d-md-block">--}}

<!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
