@extends('layouts.base')

@section('content')
<main class="main-welcome container-fluid pt-2 position-relative">
    <div class="d-flex flex-column flex-md-row align-items-start">
        
        <div class="col-lg-12 col-md-9 px-0 text-center welcome-title">
            <h5 class="font-weight-bold text-white">SỞ TÀI NGUYÊN MÔI TRƯỜNG TỈNH SƠN LA </h5>
            <h3 class="font-weight-bold text-white mt-2 mb-1">HỆ THỐNG QUẢN LÝ GIÁM SÁT, KHAI THÁC SỬ DỤNG</h3> 
            <h3 class="font-weight-bold text-white">TÀI NGUYÊN VÀ MÔI TRƯỜNG</h3></div>
        </div>
        <div class="d-flex mt-3 align-items-center justify-content-center flex-column flex-md-row">
            <div class="col-lg-4 col-md-6 d-flex col-12 justify-content-center py-2 py-md-0 order-md-1">
                <img class="w-50" src="{{asset('public/images/logo-tnmt.png')}}" />
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
                <div class="menu-item icon-meteor">
                    <div class="item-image"><img src="{{asset('public/images/icon/meteorology-icon.png')}}" alt="meteorology-icon"></div>
                    <a href="" class="item-text">Khí tượng thủy văn</a>
                </div>
                <div class="menu-item">
                    <div class="item-image icon-geo"><img src="{{asset('public/images/icon/geology-icon.png')}}" alt="geology-icon"></div>
                    <a href="" class="item-text">Địa chất khoáng sản</a>
                </div>
                <div class="menu-item">
                    <div class="item-image icon-env"><img src="{{asset('public/images/icon/env-icon.png')}}" alt="env-icon"></div>
                    <a href="" class="item-text">Môi trường</a>
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
        <a id="redirect-login-btn" @if (Auth::check()) href="{{route('logout')}}" @else href="{{route('login')}}" @endif class="redirect-login position-absolute btn btn-warning font-weight-bold">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;@if (Auth::check()) Xin chào, {{Auth::user()->username}} @else Đăng nhập @endif
        </a>
</main>
@endsection