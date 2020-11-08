@section('title', 'Hệ thống quản lý, lưu trữ thông tin, dữ liệu khí tượng thủy văn')
@extends('layouts.base')

@section('content')
<main class="main-welcom container-fluid p-0 position-relative">
    <div class="text-center w-100 bg-light">
        <h6 class="d-inline-block text-primary p-2 font-weight-bold">HỆ THỐNG QUẢN LÝ, LƯU TRỮ THÔNG TIN, DỮ LIỆU KHÍ TƯỢNG THỦY VĂN</h6>
        <span class="account-header d-inline-block px-2 float-right font-13"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Xin chào, {{Auth::user()->username}}</span>
    </div>
    @include('layouts.navigation-hydrological')
    <div class="wrap-content w-100">
        
    </div>
</main>

@endsection