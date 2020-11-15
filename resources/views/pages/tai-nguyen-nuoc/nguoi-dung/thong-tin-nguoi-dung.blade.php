@section('title', 'Thông tin tài khoản')
@extends('layouts.base')

@section('content')
  
<main class="main-welcom p-0 position-relative">
    <div class="text-center w-100 bg-light">
        <h6 class="d-inline-block text-primary p-2 font-weight-bold">HỆ THỐNG QUẢN LÝ, GIÁM SÁT, KHAI THÁC SỬ DỤNG TÀI NGUYÊN NƯỚC - TỈNH SƠN LA</h6>
        <span class="account-header d-inline-block px-2 float-right font-13"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Xin chào, {{Auth::user()->username}}</span>
    </div>
    @include('layouts.navigation-tai-nguyen-nuoc')
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    <div class="wrap-content bg-page pt-3 pb-3">
        <!-- Code -->
        <div class="card text-center w-75 mx-auto">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Thông tin tài khoản</h5>
                <hr>
                <div class="text-left row mb-3">
                    <label class="col-md-2">Họ Tên:</label>
                    <label class="col-md-9">{{$fullname}}</label>
                </div>
                <div class="text-left row mb-3">
                    <label class="col-md-2">Email:</label>
                    <label class="col-md-9">{{$email}}</label>
                </div>
                <div class="text-left row mb-3">
                    <label class="col-md-2">Số Điện Thoại:</label>
                    <label class="col-md-9"> {{$phone}} </label>
                </div>
                <div class="text-left row mb-3">
                    <label class="col-md-2">Cơ Quan:</label>
                    <label class="col-md-9"> {{$office->office_name}} </label>
                </div>
                <div class="text-left row mb-3">
                    <label class="col-md-2">Vai Trò:</label>
                    <label class="col-md-9"> {{$role->role_name}} </label>
                </div>
                <div class="justify-content-end d-flex">
                    <a href="{{ url('tai-nguyen-nuoc/nguoi-dung/password') }}" class="btn btn-warning">Đổi Mật Khẩu</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('public/js/configMap.js') }}"></script>
<script src="{{ asset('public/js/main.js') }}"></script>
@endsection