@section('title', 'Giám sát Tài nguyên & Môi trường Sơn La')
@include('layouts.header')

<main class="main-welcome pt-2 position-relative">
    <div class="d-flex justify-content-center flex-column flex-md-row align-items-start">
        
        <div class="col-lg-12 col-md-9 px-0 text-center welcome-title">
            <h4 class="font-weight-bold text-white mt-2 mb-1">QUẢN LÝ THÔNG TIN DỮ LIỆU</h4> 
            <h4 class="font-weight-bold text-white">TÀI NGUYÊN VÀ MÔI TRƯỜNG SƠN LA</h4></div>
        </div>
        <div class="d-flex mt-3 align-items-center justify-content-center flex-column flex-md-row">
            <div class="col-lg-4 col-md-6 d-flex col-12 justify-content-center py-2 py-md-0 order-md-1">
                <img width="200" height="200" src="{{asset('public/images/logo-tnmt.png')}}" />
            </div>
            <div class="welcome-menu col-md-6 col-lg-4 order-md-2">
                <div class="menu-item">
                    <div class="item-image icon-land"><img src="{{asset('public/images/icon/land-icon.png')}}" alt="land-icon"></div>
                    <a href="" class="item-text">Đất đai</a>
                </div>
                <div class="menu-item">
                    <div class="item-image icon-water"><img src="{{asset('public/images/icon/water-icon.png')}}" alt="water-icon"></div>
                    <a href="{{route('tai-nguyen-nuoc')}}" class="item-text">Tài nguyên nước</a>
                </div>
                <div class="menu-item">
                    <div class="item-image icon-geo"><img src="{{asset('public/images/icon/geology-icon.png')}}" alt="geology-icon"></div>
                    <a href="" class="item-text">Địa chất khoáng sản</a>
                </div>
                <div class="menu-item">
                    <div class="item-image icon-env"><img src="{{asset('public/images/icon/env-icon.png')}}" alt="env-icon"></div>
                    <a href="" class="item-text">Môi trường</a>
                </div>
                <div class="menu-item icon-meteor">
                    <div class="item-image"><img src="{{asset('public/images/icon/meteorology-icon.png')}}" alt="meteorology-icon"></div>
                    <a href="{{route('khi-tuong-thuy-van')}}" class="item-text">Khí tượng thủy văn</a>
                </div>
                <div class="menu-item">
                    <div class="item-image icon-map"><img src="{{asset('public/images/icon/map-icon.png')}}" alt="map-icon"></div>
                    <a href="" class="item-text">Đo đạc bản đồ và thông tin địa lý</a>
                </div>
                <div class="menu-item">
                    <div class="item-image icon-climate"><img src="{{asset('public/images/icon/global-icon.png')}}" alt="global-icon"></div>
                    <a href="" class="item-text">Biến đổi khí hậu</a>
                </div>
                <div class="menu-item">
                    <div class="item-image icon-explore"><img src="{{asset('public/images/icon/compass-icon.png')}}" alt="compass-icon"></div>
                    <a href="" class="item-text">Viễn thám</a>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row footer-content">
            <div class="info-contact text-white col-sm-12 col-md-8 col-lg-10 order-2 order-md-1 py-1 pr-0">
                <p class="text-white font-italic">Mọi thông tin xin vui lòng liên hệ :</p>
                <div class="item d-flex mt-1">
                    <div class="icon"><i class="fa fa-home" aria-hidden="true"></i></div>
                    <span>Sở Tài nguyên và Môi trường tỉnh Sơn La </span>
                </div>
                <div class="item d-flex">
                    <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <span>0212 3852 049</span>
                </div>
                <div class="item d-flex">
                    <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <span>stnmt@sonla.gov.vn</span>
                </div>
            </div>
            <div class="button-user col-sm-12 col-md-4 col-lg-2 order-1 pb-3 px-2">
                <a id="redirect-login-btn" @if (!Auth::check()) href="{{route('login')}}" @endif class="d-block my-2 redirect-login-btn btn btn-warning font-weight-bold px-1">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;@if (Auth::check()) Xin chào, {{Auth::user()->username}} @else Đăng nhập @endif
                </a>
                @if(Auth::check())
                    <a href="{{route('logout')}}" class="d-block logout-btn btn btn-danger">Đăng xuất</a>
                @endif
            </div>
        </div>
</main>
