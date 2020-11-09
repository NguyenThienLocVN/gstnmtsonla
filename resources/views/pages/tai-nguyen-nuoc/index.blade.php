@section('title', 'Hệ thống quản lý, giám sát, khai thác sử dụng tài nguyên nước')
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
    @include('layouts.navigation-water-resource')
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
            <div class="d-flex align-items-center my-2">
                <div class="col-4">
                    <span>Tên hồ:</span>
                </div>
                <div class="col-8">
                    <select class="w-100 select-lake m-1" name="lake-type" id="lake-type">
                        <option value="">Sông Mã</option>
                        <option value="">Sông Đà</option>
                    </select>
                </div>
            </div>
            <div class="info-reservoir ml-3">
                <button class="btn btn-info rounded-0 text-small"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Thông tin hồ chứa</button>
            </div>
            <div class="specification-reservoir mt-2 ml-3">
                <button class="btn btn-info rounded-0 text-small"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Thông số kỹ thuật</button>
            </div>
            <div class="warning-reservoir mt-2 mx-3">
                <h6 class="text-small p-2 text-white"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;Cảnh báo</h6>
                <div class="d-flex pt-2 text-center">
                    <div class="col-4 px-1">
                        <p class="font-weight-bold"><img class="flat-icon" src="{{ asset('public/images/icon/raining-icon.png') }}" alt="raining-icon">&nbsp;Mưa</p>
                        <p><b class="text-danger">100</b> hồ</p>
                    </div>
                    <div class="col-4 px-1">
                        <p class="font-weight-bold"><img class="flat-icon" src="{{ asset('public/images/icon/water-level-icon.png') }}" alt="raining-icon">&nbsp;Mực nước</p>
                        <p><b class="text-danger">2</b> hồ</p>
                    </div>
                    <div class="col-4 px-1">
                        <p class="font-weight-bold"><img class="flat-icon" src="{{ asset('public/images/icon/capacity.png') }}" alt="raining-icon">&nbsp;Dung tích</p>
                        <p><b class="text-danger">0</b> hồ</p>
                    </div>
                </div>
                <div class="d-flex py-2 text-center">
                    <div class="col-4 px-1">
                        <p class="font-weight-bold"><img class="flat-icon" src="{{ asset('public/images/icon/river-icon.jpg') }}" alt="raining-icon">&nbsp;Q đến</p>
                        <p><b class="text-danger">0</b> hồ</p>
                    </div>
                    <div class="col-4 px-1">
                        <p class="font-weight-bold"><img class="flat-icon" src="{{ asset('public/images/icon/lake-icon.png') }}" alt="raining-icon">&nbsp;MN sông</p>
                        <p><b class="text-danger">2</b> trạm</p>
                    </div>
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
@endsection