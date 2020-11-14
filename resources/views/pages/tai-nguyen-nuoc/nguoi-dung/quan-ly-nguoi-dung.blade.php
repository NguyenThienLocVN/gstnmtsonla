@section('title', 'Quản lý người dùng')
@extends('layouts.base')

@section('content')
<main class="main-welcom p-0 position-relative">
    <div class="text-center w-100 bg-light">
        <h6 class="d-inline-block text-primary p-2 font-weight-bold">HỆ THỐNG QUẢN LÝ, GIÁM SÁT, KHAI THÁC SỬ DỤNG TÀI NGUYÊN NƯỚC - TỈNH SƠN LA</h6>
        <span class="account-header d-inline-block px-2 float-right font-13"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Xin chào, {{Auth::user()->username}}</span>
    </div>
    @include('layouts.navigation-tai-nguyen-nuoc')
    <div class="wrap-content bg-page pt-3">
        <!-- Code -->
        <div class="overflow-auto">
            <table class="table bg-light w-table mx-auto">
                <thead class="py-0 header-table text-uppercase text-center">
                    <tr class="">
                        <th class="p-2 font-weight-300 ">stt</th>
                        <th class="p-2 font-weight-300 ">Tên đầy đủ</th>
                        <th class="p-2 font-weight-300 ">Tên đăng nhập</th>
                        <th class="p-2 font-weight-300 ">email</th>
                        <th class="p-2 font-weight-300 ">số điện thoại</th>
                        <th class="p-2 font-weight-300 ">cơ quan</th>
                        <th class="p-2 font-weight-300 ">vai trò</th>
                        <th class="p-2 font-weight-300 ">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($users as $user)
                        <tr class="text-left text-secondary ">
                            <td class="p-2 text-center">{{$i}}</td>
                            <td class="p-2 text-left">{{$user->fullname}}</td>
                            <td class="p-2 text-left">{{$user->username}}</td>
                            <td class="p-2 text-left">{{$user->email}}</td>
                            <td class="p-2 text-center">{{$user->phone}}</td>
                            <td class="p-2 text-left">{{$user->office_name}}</td>
                            <td class="p-2 text-left">{{$user->role_name}}</td>
                            <td class="p-2 text-center"><?= ($user->status == 1) ? "Đã duyệt" : "Chưa duyệt" ?> &nbsp; <?= ($user->status == 1) ? "" : "<span class='btn btn-sm btn-danger float-right mr-1'>Duyệt</span>" ?></td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                    <tr class="border-0 p-0">
                        <th colspan="9" class="p-0"> <div class="tf rounded-bottom"></div></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="{{ asset('public/js/configMap.js') }}"></script>
<script src="{{ asset('public/js/main.js') }}"></script>
@endsection