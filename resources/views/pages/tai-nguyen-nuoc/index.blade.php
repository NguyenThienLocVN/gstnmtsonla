@section('title', 'Hệ thống quản lý, giám sát, khai thác sử dụng tài nguyên nước')
@extends('layouts.base')

@section('content')
<main class="main-welcom p-0 position-relative">
    <div class="text-center w-100 bg-light">
        <h6 class="d-inline-block text-primary p-2 font-weight-bold font-15">HỆ THỐNG QUẢN LÝ, GIÁM SÁT, KHAI THÁC SỬ DỤNG TÀI NGUYÊN NƯỚC - TỈNH SƠN LA</h6>
        <span class="account-header d-inline-block px-2 float-right font-13"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Xin chào, {{Auth::user()->username}}</span>
    </div>
    @include('layouts.navigation-tai-nguyen-nuoc')
    <div class="wrap-content w-100">
        
    </div>
</main>

@endsection