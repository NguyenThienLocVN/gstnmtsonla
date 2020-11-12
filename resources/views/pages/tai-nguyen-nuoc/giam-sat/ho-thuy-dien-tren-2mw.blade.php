@section('title', 'Giám sát hồ thủy điện trên 2MW')
@extends('layouts.base')

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
   <script src="https://unpkg.com/esri-leaflet@2.5.0/dist/esri-leaflet.js" integrity="sha512-ucw7Grpc+iEQZa711gcjgMBnmd9qju1CICsRaryvX7HJklK0pGl/prxKvtHwpgm5ZHdvAil7YPxI1oWPOWK3UQ==" crossorigin=""></script>
@endpush
@section('content')
<main class="main-welcom container-fluid p-0 position-relative">
    <div class="text-center w-100 bg-light">
        <h6 class="d-inline-block text-primary p-2 font-weight-bold">HỆ THỐNG QUẢN LÝ, GIÁM SÁT, KHAI THÁC SỬ DỤNG TÀI NGUYÊN NƯỚC - TỈNH SƠN LA</h6>
        <span class="account-header d-inline-block px-2 float-right font-13"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;Xin chào, {{Auth::user()->username}}</span>
    </div>
    @include('layouts.navigation-tai-nguyen-nuoc')
    <div class="wrap-content w-100">
        <div class="content-left float-left">
            <div class="d-flex p-2 bg-primary ">
                <div>
                    <a href="{{ route('index') }}"><i class="fa fa-home text-white" aria-hidden="true"></i></a>
                </div>
                <div class="text-center col-11">
                    <b class="text-white">GIÁM SÁT, KHAI THÁC SỬ DỤNG NƯỚC</b>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between my-2">
                <div class="col-6 d-flex">
                    <input type="text" class="pl-1 w-100 font-13 rounded-0 input-filter" name="input-district" id="input-filter-district" placeholder="Chọn huyện..">
                    <span class="btn-select-dropdown text-white bg-primary text-center"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                </div>
                <div class="col-6 d-flex">
                    <input type="text" class="w-100 pl-1 font-13 rounded-0 input-filter" name="input-district" id="input-filter-region" placeholder="Chọn tiểu vùng..">
                    <span class="btn-select-dropdown text-white bg-primary text-center"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                </div>
            </div>
            <div class="construction-result col-12 my-2">
                <div class="tbl-header result-header">
                    <table cellpadding="0" cellspacing="0" border="1" class="font-13 w-100">
                        <thead>
                            <tr>
                                <th class="text-center font-weight-bold">TÊN CÔNG TRÌNH</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div>
                    <table cellpadding="0" cellspacing="0" border="1" class="font-13 w-100">
                        <tbody>
                            <tr>
                            <input type="text" class="w-100 pl-1 py-1 font-13 input-filter" name="input-district" id="input-district" placeholder="Tìm kiếm tên công trình..">
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="operate-reservoir my-2 mx-3">
                <h6 class="text-small p-2 text-white"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;Vận hành</h6>
                <div class="d-flex py-2 text-center">
                    <div class="col-6 px-1">
                        <p class="font-weight-bold"><img class="flat-icon" src="{{ asset('public/images/icon/image-icon.png') }}" alt="raining-icon">&nbsp;Hình ảnh</p>
                    </div>
                    <div class="col-6 px-1">
                        <p class="font-weight-bold"><img class="flat-icon" src="{{ asset('public/images/icon/webcam-icon.png') }}" alt="raining-icon">&nbsp;Camera</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-right float-right h-100 position-relative">
            <div id="map" class="map h-100"></div>
            <select id="layer-select" class="position-absolute">
                <option value="Imagery">Bản đồ vệ tinh</option>
                <option value="Topographic">Bản đồ địa hình</option>
                <option value="Streets">Bản đồ đường</option>
                <option value="NationalGeographic">Bản đồ địa lý</option>
                <option value="ImageryClarity">Bản đồ vệ tinh 2</option>
            </select>
        </div>
    </div>
</main>

<script src="{{ asset('public/js/configMap.js') }}"></script>
<script src="{{ asset('public/js/main.js') }}"></script>
@endsection