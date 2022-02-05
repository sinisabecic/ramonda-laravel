<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
        {{--        <div class="sidebar-brand-icon rotate-n-15">--}}
        {{--            <i class="fas fa-laugh-wink"></i>--}}
        {{--        </div>--}}
        <div class="sidebar-brand-text mx-3">
            {{ config('app.name') }}


            @switch(auth()->user()->role()->name)
                @case(ucfirst("admin"))
                <span
                    class="badge bg-gradient-dark">{{ auth()->user()->role()->name }}</span>
                @break
                @case(ucfirst("user"))
                <span
                    class="badge badge-pill badge-success">{ auth()->user()->role()->name }}</span>
                @break
                @case(ucfirst("subscriber"))
                <span
                    class="badge badge-pill badge-warning text-dark">{{ auth()->user()->role()->name }}</span>
                @break
                @case(ucfirst("partner"))
                <span
                    class="badge badge-pill badge-info">{{ auth()->user()->role()->name }}</span>
                @break
                @case(ucfirst("author"))
                <span
                    class="badge badge-pill badge-primary">{{ auth()->user()->role()->name }}</span>
                @break
                @default
                <span
                    class="badge badge-pill badge-danger">{{ auth()->user()->role()->name }}</span>
            @endswitch

        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(Str::contains(request()->route()->getName(), 'admin')) active @endif">
        <a class="nav-link" href="{{route('admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

{{--    <!-- Divider -->--}}
{{--    <hr class="sidebar-divider">--}}

<!-- Nav Item - Tables -->
    @if (auth()->check() && auth()->user()->hasRole('admin'))
        <li class="nav-item @if(Str::contains(request()->route()->getName(), ['users', 'roles', 'permissions'])) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-power-off"></i>
                <span>Authorization</span>
            </a>
            <div id="collapseOne"
                 class="collapse @if(Str::contains(request()->route()->getName(), ['users', 'roles', 'permissions'])) show @endif"
                 aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded-sm">
                    <h6 class="collapse-header">Manage authorization:</h6>
                    <a class="collapse-item @if(Str::contains(request()->route()->getName(), 'users')) active @endif"
                       href="{{ route('users') }}">
                        <i class="fas fa-fw fa-user"></i>
                        Users
                    </a>
                    <a class="collapse-item @if(Str::contains(request()->route()->getName(), 'roles')) active @endif"
                       href="{{ route('roles') }}">
                        <i class="fas fa-user-tag"></i>
                        Roles
                    </a>
                    <a class="collapse-item @if(Str::contains(request()->route()->getName(), 'permissions')) active @endif"
                       href="{{ route('permissions') }}">
                        <i class="fas fa-ban"></i>
                        Permissions
                    </a>
                </div>
            </div>
        </li>
    @endif

    <li class="nav-item @if(Str::contains(request()->route()->getName(), 'blog')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-blog"></i>
            <span>Blog</span>
        </a>
        <div id="collapseTwo" class="collapse @if(Str::contains(request()->route()->getName(), 'blog')) show @endif"
             aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded-sm">
                <h6 class="collapse-header">Custom blog:</h6>
                <a class="collapse-item @if(Str::contains(request()->route()->getName(), 'posts')) active @endif"
                   href="{{ route('blog.posts') }}">
                    <i class="fas fa-clipboard-list"></i>
                    Posts
                </a>
                <a class="collapse-item @if(Str::contains(request()->route()->getName(), 'categories')) active @endif"
                   href="{{ route('blog.categories') }}">
                    <i class="fas fa-align-justify"></i>
                    Categories
                </a>
                <a class="collapse-item @if(Str::contains(request()->route()->getName(), 'tags')) active @endif"
                   href="{{ route('blog.tags') }}">
                    <i class="fas fa-hashtag"></i>
                    Tags
                </a>
                <a class="collapse-item @if(Str::contains(request()->route()->getName(), 'comments')) active @endif"
                   href="{{ route('blog.comments') }}">
                    <i class="fas fa-user-slash"></i>
                    Comments
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-photo-video"></i>
            <span>Components</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded-sm">
                <h6 class="collapse-header">Custom media:</h6>
                <a class="collapse-item" href="{{ route('media.photos') }}">All media</a>
                <a class="collapse-item" href="cards.html">Upload media</a>
            </div>
        </div>
    </li>

{{--    <!-- Divider -->--}}
{{--    <hr class="sidebar-divider d-none d-md-block">--}}

<!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
