@section('title', 'Quản lý giấy phép khai thác sử dụng nước mặt')
@extends('layouts.base-wr')

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
   <script src="https://unpkg.com/esri-leaflet@2.5.0/dist/esri-leaflet.js" integrity="sha512-ucw7Grpc+iEQZa711gcjgMBnmd9qju1CICsRaryvX7HJklK0pGl/prxKvtHwpgm5ZHdvAil7YPxI1oWPOWK3UQ==" crossorigin=""></script>
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
                <div class="col-6 position-relative validate-input m-b-26">
                    <div class="d-flex">
                        <input type="text" class="pl-1 w-100 font-13 rounded-0 input-filter" name="district" id="filter-district" placeholder="Chọn huyện..">
                        <span id="btn-select-dropdown-district" class="btn-select-dropdown base-bgcolor text-white text-center"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                    </div>
                    <ul id="dropdownlist-district" style="display: none;" class="dropdownlist-common position-absolute font-13 text-left bg-light"> 
                        @foreach($districts as $district)
                            <li class="p-1 district_id" id="{{$district->id}}">{{$district->district_name}}</li>
                        @endforeach
                        <input type="hidden" name="district_id" id="district_id">
                    </ul>
                </div>
                <div class="col-6 position-relative validate-input m-b-26">
                    <div class="d-flex">
                        <input type="text" class="pl-1 w-100 font-13 rounded-0 input-filter" name="subregion" id="filter-subregion" placeholder="Chọn tiểu vùng..">
                        <span id="btn-select-dropdown-subregion" class="btn-select-dropdown base-bgcolor text-white text-center"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                    </div>
                    <ul id="dropdownlist-subregion" style="display: none;" class="dropdownlist-common position-absolute font-13 text-left bg-light">
                        @foreach($subregions as $subregion)
                            <li class="p-1 subregion_id" id="{{$subregion->id}}">{{$subregion->subregion_name}}</li>
                        @endforeach
                        <input type="hidden" name="subregion_id" id="subregion_id">
                    </ul>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between my-2">
                <div class="col-12 position-relative validate-input m-b-26">
                    <div class="d-flex">
                        <input type="text" class="pl-1 w-100 font-13 rounded-0 input-filter" name="construction" id="filter-construction" placeholder="Chọn công trình..">
                        <span id="btn-select-dropdown-construction" class="btn-select-dropdown base-bgcolor text-white text-center"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                    </div>
                    <ul id="dropdownlist-construction" style="display: none;" class="dropdownlist-common position-absolute font-13 text-left bg-light">
                        @foreach($constructions as $construction)
                        <li class="p-1 construction_id" id="{{$construction->id}}">{{$construction->construction_name}}</li>
                        @endforeach
                        <input type="hidden" name="construction_id" id="construction_id">
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="license-info">
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Tên công trình</div>
                    <div class="col-8 position-relative"><input class="form-control" type="text" name="input-construction-name" class="input-construction-name" id="input-construction-name" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Chủ đầu tư</div>
                    <div class="col-8 w-100"><input class="form-control" type="text" name="input-investor" id="input-investor" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Số giấy phép</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-license-num" id="input-license-num" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Ngày cấp</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-license-date" id="input-license-date" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Thời hạn GP</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-license-duration" id="input-license-duration" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Cơ quan cấp</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-license-by" id="input-license-by" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Nguồn nước</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-water-source" id="input-water-source" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Vị trí địa lý</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-location" id="input-location" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Tọa độ đập chính</div>
                    <div class="col-8 d-flex align-items-center"><span class="col-1 p-0">X</span><input class="form-control col-6" type="text" name="input-lat-dams" id="input-lat-dams" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15"></div>
                    <div class="col-8 d-flex align-items-center"><span class="col-1 p-0">Y</span><input class="form-control col-6" type="text" name="input-long-dams" id="input-long-dams" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Tọa độ nhà máy</div>
                    <div class="col-8 d-flex align-items-center"><span class="col-1 p-0">X</span><input class="form-control col-6" type="text" name="input-lat-factory" id="input-lat-factory" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15"></div>
                    <div class="col-8 d-flex align-items-center"><span class="col-1 p-0">Y</span><input class="form-control col-6" type="text" name="input-long-factory" id="input-long-factory" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Chế độ khai thác</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-extraction-mode" id="input-extraction-mode" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Lượng nước khai thác</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-flow" id="input-flow" readonly></div>
                </div>
                <div class="col-12 d-flex mb-1 align-items-center">
                    <div class="col-4 p-0 font-weight-bold font-15">Phương thức khai thác</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-extraction-method" id="input-extraction-method" readonly></div>
                </div>
                <div class="d-flex my-4">
                    <div class="col-12">
                        <button type="button" class="btn btn-success">Sửa</button>
                        <button type="button" class="btn btn-warning mx-2">Cập nhật</button>
                        <button type="button" class="btn btn-danger">Quay lại</button>
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
    </div>
    <script src="{{ asset('public/js/configMap.js') }}"></script>
    <script src="{{ asset('public/js/waterResources.js') }}"></script>
@endsection