@section('title', 'Quản lý giấy phép khai thác sử dụng nước mặt')
@extends('layouts.base-wr')

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet@2.5.0/dist/esri-leaflet.js" integrity="sha512-ucw7Grpc+iEQZa711gcjgMBnmd9qju1CICsRaryvX7HJklK0pGl/prxKvtHwpgm5ZHdvAil7YPxI1oWPOWK3UQ==" crossorigin=""></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endpush
@section('content')
    <div class="h-100 w-100 position-relative">
        <div class="content-left h-100 float-left position-relative">
            <img src="{{ asset('public/images/loading.gif') }}" id="loading-gif-image" class="loading-gif position-absolute" alt="loading" style="display: none;">
            <div id="overlay"></div>
            <div class="d-flex p-2 base-bgcolor ">
                <div>
                    <span href="" class="text-white" id="toggle-sidebar" title="Mở rộng menu"><i class="fa fa-expand" aria-hidden="true"></i></span>
                </div>
                <div class="text-center col-11">
                    <b class="text-white">Quản lý cấp phép khai thác sử dụng nước mặt</b>
                </div>
            </div>
            <div class="d-flex align-items-center my-2">
                <div class="col-6 position-relative validate-input m-b-26 font-13">
                    <select class="w-100" name="" id="dropdownlist-district">
                        <option value="" disabled selected>Chọn huyện ...</option>
                        @foreach($districts as $district)
                            <option value="{{$district->code}}">{{$district->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 position-relative validate-input m-b-26 font-13">
                    <select class="w-100" name="" id="dropdownlist-commune">
                        <option value="" disabled selected>Chọn xã ...</option>
                        @foreach($communes as $commune)
                            <option value="{{$commune->code}}">{{$commune->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between my-2">
                <div class="col-12 position-relative validate-input m-b-26 font-13">
                    <select class="w-100" name="" id="dropdownlist-construction">
                        <option value="" disabled selected>Chọn công trình..</option>
                        @foreach($constructions as $construction)
                            <option value="{{$construction->license_num}}" id="{{$construction->lat_dams}},{{$construction->long_dams}}">{{$construction->construction_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="license-info">
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Tên công trình</div>
                    <div class="col-8 position-relative"><span id="input-construction-name"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Chủ đầu tư</div>
                    <div class="col-8 w-100"><span id="input-investor"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Số giấy phép</div>
                    <div class="col-8"><span id="input-license-num"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Ngày cấp</div>
                    <div class="col-8"><span id="input-license-date"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Thời hạn GP</div>
                    <div class="col-8"><span id="input-license-duration"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Cơ quan cấp</div>
                    <div class="col-8"><span id="input-license-by"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Nguồn nước</div>
                    <div class="col-8"><span id="input-water-source"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Vị trí địa lý</div>
                    <div class="col-8"><span id="input-location"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Tọa độ đập chính</div>
                    <div class="col-8 d-flex align-items-center"><span class="col-2 p-0">X :</span>&nbsp;<span id="input-lat-dams"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15"></div>
                    <div class="col-8 d-flex align-items-center"><span class="col-2 p-0">Y :</span>&nbsp;<span id="input-long-dams"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Tọa độ nhà máy</div>
                    <div class="col-8 d-flex align-items-center"><span class="col-2 p-0">X :</span>&nbsp;<span id="input-lat-factory"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15"></div>
                    <div class="col-8 d-flex align-items-center"><span class="col-2 p-0">Y :</span>&nbsp;<span id="input-long-factory"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Chế độ khai thác</div>
                    <div class="col-8"><span id="input-extraction-mode"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Phương thức khai thác</div>
                    <div class="col-8"><span id="input-extraction-method"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Công suất</div>
                    <div class="col-8"><span id="input-wattage"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Dòng chảy lớn nhất</div>
                    <div class="col-8"><span id="input-max-flow"></span></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Q<sub>TT</sub></div>
                    <div class="col-8"><span id="input-min-flow"></span></div>
                </div>
                <div class="d-flex my-4">
                    <div class="col-12">
                        <button type="button" class="btn btn-success">Xem PDF</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-right h-100 float-right position-relative">
            <div id="map" class="map h-100"></div>
            <select id="layer-select" class="position-absolute">
                <option value="Imagery">Bản đồ vệ tinh</option>
                <option value="Topographic">Bản đồ địa hình</option>
                <option value="Streets">Bản đồ đường</option>
                <option value="NationalGeographic">Bản đồ địa lý</option>
                <option value="ImageryClarity">Bản đồ vệ tinh 2</option>
            </select>
        </div>

        <textarea id="locationJson" class="d-none">{!! $locationJson !!}</textarea>
    </div>
    <script src="{{ asset('public/js/configMap.js') }}"></script>
    <script src="{{ asset('public/js/waterResources.js') }}"></script>
@endsection