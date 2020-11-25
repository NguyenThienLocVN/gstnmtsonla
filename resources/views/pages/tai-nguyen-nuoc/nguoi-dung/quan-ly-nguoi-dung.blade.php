@section('title', 'Quản lý người dùng')
@extends('layouts.base-wr')

@section('content')
    <div class="wrap-content bg-page pt-3 pb-3">
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
                            <td class="p-2 text-center"><?= ($user->status == 1) ? "Đã duyệt" : "Chưa duyệt" ?> &nbsp; <?= ($user->status == 1) ? "" : "<button onclick='' class='btn btn-sm btn-danger'>Duyệt</button>" ?></td>
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

<script src="{{ asset('public/js/configMap.js') }}"></script>
<script src="{{ asset('public/js/main.js') }}"></script>
@endsection