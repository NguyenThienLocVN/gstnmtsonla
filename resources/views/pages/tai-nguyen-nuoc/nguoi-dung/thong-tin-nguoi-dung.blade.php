@section('title', 'Thông tin tài khoản')
@extends('layouts.base-wr')

@section('content')
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
                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

<script src="{{ asset('public/js/configMap.js') }}"></script>
<script src="{{ asset('public/js/main.js') }}"></script>
@endsection