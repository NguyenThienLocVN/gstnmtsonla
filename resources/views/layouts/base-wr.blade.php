@include('layouts.header')

<div class="container-fluid p-0">
    <div class="text-center w-100 bg-lightgray">
        <a href="{{ route('index') }}" class="base-color float-left btn-back" title="Quay lại"><i class="fa fa-reply-all" aria-hidden="true"></i></a>
        <h6 class="d-inline-block base-color p-2 font-weight-bold font-15">HỆ THỐNG QUẢN LÝ, GIÁM SÁT, KHAI THÁC SỬ DỤNG TÀI NGUYÊN NƯỚC</h6>
        <a href="{{ route('logout') }}" class="account-header account-logout d-inline-block px-2 float-right font-13 position-relative"></i>Đăng xuất</a>
        <a href="{{ route('thong-tin-nguoi-dung') }}" title="Thông tin tài khoản" class="account-header account-info d-inline-block px-2 float-right font-13 position-relative"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Xin chào, {{Auth::user()->username}}</a>
    </div>
    <div class="d-flex w-100 main-content">
        <div class="col-2 collapse show p-0 h-100" id="sidebar"  aria-expanded="false">
            <a class="d-block text-center py-3" href="{{ route('tai-nguyen-nuoc') }}">
                <img src="{{ asset('public/images/logo-tnmt.png') }}" alt="logo-sidebar" class="logo-sidebar w-50">
            </a>
            <ul class="nav flex-column w-100 flex-nowrap overflow-hidden">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-truncate" href="#"><i class="fa fa-home"></i> <span class="d-none d-sm-inline">GIỚI THIỆU</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-truncate" href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i> <span class="d-none d-sm-inline">QUAN TRẮC</span></a>
                </li>
                <li class="nav-item {{  request()->is('tai-nguyen-nuoc/giam-sat/*') ? 'active' : '' }}">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu1"><i class="fa fa-unlock-alt" aria-hidden="true"></i><span class="d-none d-sm-inline">GIÁM SÁT</span></a>
                    <div class="collapse {{  request()->is('tai-nguyen-nuoc/giam-sat/*') ? 'show' : '' }}" id="submenu1" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold {{  request()->is('tai-nguyen-nuoc/giam-sat/ho-thuy-dien-tren-2mw') ? 'active' : '' }}" href="{{ route('ho-thuy-dien-tren-2mw') }}"><span>Hồ chứa trên 2MW</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Hồ chứa dưới 2MW</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Hồ thủy lợi</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Trạm bơm</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Công trình khai thác, sử dụng NDĐ</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{  request()->is('tai-nguyen-nuoc/cap-phep/*') ? 'active' : '' }}">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu2" data-toggle="collapse" data-target="#submenu2"><i class="fa fa-pencil" aria-hidden="true"></i> <span class="d-none d-sm-inline">CẤP PHÉP</span></a>
                    <div class="collapse {{  request()->is('tai-nguyen-nuoc/cap-phep/*') ? 'show' : '' }}" id="submenu2" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link font-weight-bold {{  request()->is('tai-nguyen-nuoc/cap-phep/nuoc-mat') ? 'active' : '' }}" href="{{ route('cap-phep-nuoc-mat') }}"><span>QLCP khai thác sử dụng nước mặt </span></a></li>
                            <li class="nav-item"><a class="nav-link font-weight-bold" href="#"><span>QLCP khai thác sử dụng nước dưới đất </span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu3" data-toggle="collapse" data-target="#submenu3"><i class="fa fa-table"></i> <span class="d-none d-sm-inline">THÔNG TIN DỮ LIỆU</span></a>
                    <div class="collapse" id="submenu3" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Tiểu vùng TNN </span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Số lượng, chất lượng nước mặt, nước dưới đất </span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Số liệu điều tra khảo sát địa chất thủy văn  </span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Kết quả cấp, gia hạn, thu hồi, điều chỉnh giấy phép  </span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu4" data-toggle="collapse" data-target="#submenu4"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="d-none d-sm-inline">THÔNG BÁO</span></a>
                    <div class="collapse" id="submenu4" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Tổ chức/ cá nhân </span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Cơ quan nhà nước   </span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-truncate" href="{{ route('tai-nguyen-nuoc.bao-cao') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="d-none d-sm-inline">BÁO CÁO</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu5" data-toggle="collapse" data-target="#submenu5"><i class="fa fa-user-circle" aria-hidden="true"></i><span class="d-none d-sm-inline">NGƯỜI DÙNG</span></a>
                    <div class="collapse" id="submenu5" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="{{ route('quan-ly-nguoi-dung') }}"><span>Quản lý người dùng </span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-truncate" href="{{ route('admin') }}"><i class="fa fa-address-book-o" aria-hidden="true"></i> <span class="d-none d-sm-inline">QUẢN TRỊ</span></a>
                </li>
            </ul>
        </div>
        <div class="col p-0 h-100">
            @yield('content')
        </div>
    </div>
</div>

@include('layouts.footer')