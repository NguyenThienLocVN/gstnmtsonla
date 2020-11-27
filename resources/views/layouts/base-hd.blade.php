@include('layouts.header')

<div class="container-fluid p-0">
    <div class="text-center w-100 bg-light">
        <a href="{{ route('index') }}" class="base-color float-left btn-back" title="Quay lại"><i class="fa fa-reply-all" aria-hidden="true"></i></a>
        <h6 class="d-inline-block base-color p-2 font-weight-bold font-15">HỆ THỐNG QUẢN LÝ, LƯU TRỮ THÔNG TIN, DỮ LIỆU KHÍ TƯỢNG THỦY VĂN</h6>
        <span class="account-header d-inline-block px-2 float-right font-13 position-relative"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Xin chào, {{Auth::user()->username}}</span>
    </div>
    <div class="d-flex w-100 main-content">
        <div class="col-2 collapse show p-0 min-vh-100" id="sidebar"  aria-expanded="false">
            <ul class="nav flex-column w-100 flex-nowrap overflow-hidden">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-truncate" href="#"><i class="fa fa-home"></i> <span class="d-none d-sm-inline">GIỚI THIỆU</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu0" data-toggle="collapse" data-target="#submenu0"><i clss="fa fa-unlock-alt" aria-hidden="true"></i><span class="d-none d-sm-inline">QUAN TRẮC</span></a>
                    <div class="collapse" id="submenu0" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Số liệu khí tượng</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Số liệu mưa</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Số liệu thủy văn </span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu1" data-toggle="collapse" data-target="#submenu1"><i class="fa fa-unlock-alt" aria-hidden="true"></i><span class="d-none d-sm-inline">DỰ BÁO</span></a>
                    <div class="collapse" id="submenu1" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Bản tin dự báo thời tiết, thủy văn hàng ngày</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Bản tin dự báo khí tượng thủy văn 10 ngày</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Tuần báo khí tượng </span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Thông báo khí tượng tháng</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Bản tin dự báo bão, Áp thấp nhiệt đới</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Bản tin dự báo, cảnh báo mưa giông</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Bản tin dự báo, cảnh báo mưa lớn</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Bản tin dự báo, cảnh báo lũ, lũ quét và sạt lở </span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Bản tin dự báo, cảnh báo rét, rét đậm, rét hại</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu2" data-toggle="collapse" data-target="#submenu2"><i class="fa fa-pencil" aria-hidden="true"></i> <span class="d-none d-sm-inline">HỒ SƠ</span></a>
                    <div class="collapse" id="submenu2" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link font-weight-bold" href="#"><span>Cấp giấy phép hoạt động dự báo, cảnh báo KTTV </span></a></li>
                            <li class="nav-item"><a class="nav-link font-weight-bold" href="#"><span>Cấp phép gia hạn, sửa đổi, bổ sung giấy phép hoạt động dự báo, cảnh báo KTTV </span></a></li>
                            <li class="nav-item"><a class="nav-link font-weight-bold" href="#"><span>Cấp lại giấy phép hoạt động dự báo, cảnh báo KTTV  </span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu3" data-toggle="collapse" data-target="#submenu3"><i class="fa fa-table"></i> <span class="d-none d-sm-inline">BIẾN ĐỔI KHÍ HẬU</span></a>
                    <div class="collapse" id="submenu3" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Kết quả đánh giá khí hậu quốc gia</span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Kịch bản biến đổi khí hậu chi tiết cho tỉnh Sơn La </span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link have-submenu font-weight-bold collapsed text-truncate" href="#submenu4" data-toggle="collapse" data-target="#submenu4"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="d-none d-sm-inline">CHƯƠNG TRÌNH</span></a>
                    <div class="collapse" id="submenu4" aria-expanded="false">
                        <ul class="flex-column nav submenu-list">
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Do Quốc hội, Chính phủ, Thủ tướng chính phủ ban hành </span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Do Bộ TNMT và các Bộ có liên quan ban hành </span></a></li>
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Do UBND tỉnh ban hành</span></a></li>
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
                            <li class="nav-item"><a class="nav-link py-1 font-weight-bold" href="#"><span>Nhật ký sử dụng   </span></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col p-0">
            @yield('content')
        </div>
    </div>
</div>

@include('layouts.footer')