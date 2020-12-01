<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img class="user-image" src="{{asset('public/admin/images/avatar.png')}}" alt="">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->username}}</p>
                <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree" data-animation-speed="300">

            {{--@if(Auth::guard('admin')->user()->level == 1)--}}
            <li class="treeview">
                <a href="javascript:void(0)"><i class="fa fa-map-o"></i><span>Quản lý huyện, xã</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('cities.index')}}"><i class="fa fa-circle-o"></i> Danh sách</a>
                    </li>
                    <li><a href="{{route('cities.create')}}"><i class="fa fa-circle-o"></i> Thêm mới</a>
                    </li>
                    <li><a href="#" data-toggle="modal" data-target="#importData"><i class="fa fa-circle-o"></i>Thêm bằng excel</a></li>
                </ul>
            </li>

            {{--@endif--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>