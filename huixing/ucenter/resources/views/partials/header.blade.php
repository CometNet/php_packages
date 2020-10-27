<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/vendor/ucneter/AdminLTE/index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
{{--        @include("admin::widgets.chat")--}}
{{--        @include("admin::widgets.notification")--}}
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!-- User Account Menu -->
        <li class="nav-item dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <!-- The user image in the navbar-->
            <img style="margin-top: 3px;" src="{{ UCenter::user()->avatar }}" data-toggle="dropdown" class="elevation-2 user-image dropdown-toggle" alt="User Image">
            <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                    <img src="{{ UCenter::user()->avatar }}" class="img-circle" alt="User Image">

                    <p>
                        {{ UCenter::user()->name }}
                        <small>Member since admin {{ UCenter::user()->created_at }}</small>
                    </p>
                </li>
                <li class="user-footer">
                    <div class="float-left">
                        <a href="{{ ucenter_url('auth/setting') }}" class="btn btn-default btn-flat">{{ trans('ucenter.setting') }}</a>
                    </div>
                    <div class="float-right">
                        <a href="{{ ucenter_url('auth/logout') }}" class="btn btn-default btn-flat">{{ trans('ucenter.logout') }}</a>
                    </div>
                </li>
            </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
{{--        @include("admin::widgets.control-sidebar")--}}
    </ul>
</nav>
<!-- /.navbar -->
