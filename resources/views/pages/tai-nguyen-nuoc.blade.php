@section('title', 'Hệ thống quản lý, giám sát, khai thác sử dụng tài nguyên nước')
@extends('layouts.base')

@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/css/ol.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/build/ol.js"></script>
@endpush
@section('content')
<main class="main-welcom container-fluid p-0 position-relative">
    <div class="text-center w-100 bg-light">
        <h6 class="text-primary p-2 font-weight-bold">HỆ THỐNG QUẢN LÝ, GIÁM SÁT, KHAI THÁC SỬ DỤNG TÀI NGUYÊN NƯỚC - TỈNH SƠN LA</h6>
    </div>
    @include('layouts.navigation-water-resource')
    <div class="wrap-content w-100">
        <div class="content-left float-left h-100">
            <div class="d-flex p-2 bg-primary ">
                <div>
                    <i class="fa fa-home text-white" aria-hidden="true"></i>
                </div>
                <div class="text-center col-12">
                    <b class="text-white">QUAN TRẮC HỒ CHỨA</b>
                </div>
            </div>
            <div class="d-flex align-items-center">
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
            <div class="info-reservoir mt-4 ml-3">
                <button class="btn btn-info rounded-0 text-small"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;Thông tin hồ chứa</button>
            </div>
            <div class="specification-reservoir mt-2 ml-3">
                <button class="btn btn-info rounded-0 text-small"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Thông số kỹ thuật</button>
            </div>
            <div class="oparate-reservoir mt-2 mx-3">
                <h6 class="text-small p-2 text-white"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;Cảnh báo</h6>
                <div class="d-flex pt-3 py-1 text-center">
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
        </div>
        <div class="content-right float-right h-100">
            <div id="map" class="map h-100"></div>
        </div>
    </div>
</main>

<script src="{{ asset('public/js/openLayersSonLa.js') }}"></script>
@endsection