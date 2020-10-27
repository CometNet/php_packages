<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="/vendor/ucenter/AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('ucenter.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ UCenter::user()->avatar }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{UCenter::user()->name}}</a>
            </div>
        </div>

{{--        @if(config('admin.enable_menu_search'))--}}
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" autocomplete="off" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append"><button class="btn btn-sidebar"><i class="fas fa-search fa-fw"></i></button></div>
                <ul class="dropdown-menu" role="menu" style="min-width: 210px;max-height: 300px;overflow: auto;">
                    @foreach(UCenter::menuLinks() as $link)
                        <li>
                            <a href="{{ ucenter_url($link['uri']) }}"><i class="fa {{ $link['icon'] }}"></i>{{ ucenter_trans($link['title']) }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
{{--        @endif--}}
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="sidebar-menu nav nav-pills nav-sidebar flex-column nav-child-indent nav-collapse-hide-child nav-flat nav-compact text-sm" data-widget="treeview" role="menu" data-accordion="false">
                @each('ucenter::partials.menu', UCenter::menu(), 'item')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
