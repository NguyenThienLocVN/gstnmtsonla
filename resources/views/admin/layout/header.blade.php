
<header class="main-header">
    <!-- Logo -->
    <a href="{{route('admin')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        {{--<span class="logo-mini"><b>A</b>LT</span>--}}
        <!-- logo for regular state and mobile devices -->
        {{--<span class="logo-lg"><b>Admin</b>LTE</span>--}}
        <img src="{{asset('public/images/logo-tnmt.png')}}" alt="" style="height: 100%;">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="avatar dropdown-toggle" data-toggle="dropdown">
                            <img class="user-image" src="{{asset('public/admin/images/avatar.png')}}" alt="">
                        <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img class="user-image" src="{{asset('public/admin/images/avatar.png')}}" alt="">
                            <p>

                                <small>Member since 2020</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
