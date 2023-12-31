<?php
$menu = config('menu');

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- Sidebar -->
    <div class="sidebar" style="position:fixed">
        <a href="index3.html" class="brand-link">
            <img src="{{asset('ad123/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('uploads/users/'.Auth::user()->photo)}}" class="img-circle elevation-2" alt="User Image">
                </div>
            <div class="info">
                @if (Auth::check())
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
                @endif
                <a href="{{route('logoutAdmin')}}" class="d-block">Đăng xuất</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @foreach ($menu as $m)
                    <li class="nav-item">
                        <a href="{{route($m['route'])}}" class="nav-link">
                            <i class="nav-icon fas {{$m['icon']}}"></i>
                            <p>
                               {{$m['label']}}
                               @if (isset($m['item']))
                               <i class="right fas fa-angle-left"></i>
                               @endif

                            </p>
                        </a>
                        @if (isset($m['item']))
                        <ul class="nav nav-treeview">
                            @foreach ($m['item'] as $mit )
                            <li class="nav-item">
                                <a href="{{route($mit['route'])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{$mit['label']}}</p>
                                </a>
                            </li>
                            @endforeach

                        </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
