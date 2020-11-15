<nav class="navbar navbar-expand-lg navbar-dark main-navigation p-0">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
    <a class="d-block"><i class="fa fa-align-justify" aria-hidden="true"></i></a>
  </button>
  <div class="collapse navbar-collapse" id="main_nav">
<ul class="navbar-nav justify-content-between w-100">
	<li class="wr-navigation-item nav-item font-weight-bold active"> <a class="nav-link px-2 py-0 font-13" href="#">GIỚI THIỆU </a> </li>
    <li class="wr-navigation-item nav-item font-weight-bold dropdown position-relative">
	    <a class="nav-link px-2 py-0 font-13 dropdown-toggle" href="#" data-toggle="dropdown">  GIÁM SÁT  </a>
	    <ul class="dropdown-menu p-0 sub-menu rounded-0 border-0">
            <li class="dropdown-item py-1 px-2"><a href="{{ route('ho-thuy-dien-tren-2mw') }}">Hồ chứa thủy điện trên 2MW </a></li>
            <li class="dropdown-item py-1 px-2"><a href="#">Hồ chứa thủy điện dưới 2MW </a></li>
            <li class="dropdown-item py-1 px-2"><a href="#">Hồ thủy lợi </a></li>
            <li class="dropdown-item py-1 px-2"><a href="#">Trạm bơm </a></li>
            <li class="dropdown-item py-1 px-2"><a href="#">Công trình khai thác, sử dụng NDĐ </a></li>
	    </ul>
	</li>
    <li class="wr-navigation-item nav-item font-weight-bold position-relative">
        <a class="nav-link px-2 py-0 font-13 dropdown-toggle" href="#" data-toggle="dropdown">CẤP PHÉP</a>
        <ul class="dropdown-menu p-0 sub-menu rounded-0 border-0">
            <li class="dropdown-item py-1 px-2"><a href="#">QLCP khai thác sử dụng nước mặt </a></li>
            <li class="dropdown-item py-1 px-2"><a href="#">QLCP khai thác sử dụng nước dưới đất </a></li>
        </ul>
    </li>
	<li class="wr-navigation-item nav-item font-weight-bold position-relative">
        <a href="#" class="nav-link px-2 py-0 font-13 dropdown-toggle">THÔNG TIN DỮ LIỆU</a>
        <ul class="dropdown-menu p-0 sub-menu rounded-0 border-0">
            <li class="dropdown-item py-1 px-2"><a href="#">Tiểu vùng TNN </a></li>
            <li class="dropdown-item py-1 px-2"><a href="#">Số lượng, chất lượng nước mặt, nước dưới đất </a></li>
            <li class="dropdown-item py-1 px-2"><a href="#">Số liệu điều tra khảo sát địa chất thủy văn </a></li>
            <li class="dropdown-item py-1 px-2"><a href="#">Kết quả cấp, gia hạn, thu hồi, điều chỉnh giấy phép </a></li>
        </ul>
    </li>
    <li class="wr-navigation-item nav-item font-weight-bold position-relative">
        <a href="#" class="nav-link px-2 py-0 font-13 dropdown-toggle">THÔNG BÁO</a>
        <ul class="dropdown-menu p-0 sub-menu rounded-0 border-0">
            <li class="dropdown-item py-1 px-2"><a href="#">Tổ chức/ cá nhân </a></li>
            <li class="dropdown-item py-1 px-2"><a href="#">Cơ quan nhà nước  </a></li>
        </ul>
    </li>
    <li class="wr-navigation-item nav-item font-weight-bold">
        <a href="{{ route('tai-nguyen-nuoc.bao-cao') }}" class="nav-link px-2 py-0 font-13">BÁO CÁO</a>
    </li>
    <li class="wr-navigation-item nav-item font-weight-bold position-relative">
        <a href="#" class="nav-link px-2 py-0 font-13 dropdown-toggle">NGƯỜI DÙNG</a>
        <ul class="dropdown-menu p-0 sub-menu rounded-0 border-0">
            <li class="dropdown-item py-1 px-2"><a href="{{ url('tai-nguyen-nuoc/nguoi-dung/thong-tin-nguoi-dung') }}">Thông tin tài khoản </a></li>
            @if(Auth::user()->role_id == 1)
                <li class="dropdown-item py-1 px-2"><a href="{{ url('tai-nguyen-nuoc/nguoi-dung/quan-ly-nguoi-dung') }}">Quản lý người dùng </a></li>
                <li class="dropdown-item py-1 px-2"><a href="#">Nhật ký sử dụng </a></li>
            @endif
            <li class="dropdown-item py-1 px-2"><a href="{{ route('logout') }}">Đăng xuất  </a></li>
        </ul>
    </li>
</ul>
</nav>