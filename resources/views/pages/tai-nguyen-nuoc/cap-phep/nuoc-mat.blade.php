@section('title', 'Quản lý giấy phép khai thác sử dụng nước mặt')
@extends('layouts.base-wr')

@section('content')
    <div class="wrap-content w-100 position-relative">
        <img src="{{ asset('public/images/loading.gif') }}" id="loading-gif-image" class="loading-gif position-absolute" alt="loading" style="display: none;">
        <div id="overlay"></div>
        <h3 class="font-17 font-weight-bold p-3"><i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;Quản lý cấp phép khai thác sử dụng nước mặt</h3>
        <div class="d-flex align-items-center my-2">
            <div class="col-2 position-relative validate-input m-b-26">
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
            <div class="col-2 position-relative validate-input m-b-26">
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
            <div class="col-4 position-relative validate-input m-b-26">
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
            <div class="d-flex">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Tên công trình</div>
                    <div class="col-8 position-relative"><input class="form-control" type="text" name="input-construction-name" class="input-construction-name" id="input-construction-name" readonly></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Chủ đầu tư</div>
                    <div class="col-8 w-100"><input class="form-control" type="text" name="input-investor" id="input-investor" readonly></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Số GP</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-license-num" id="input-license-num" readonly></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Ngày cấp</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-license-date" id="input-license-date" readonly></div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Thời hạn GP</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-license-duration" id="input-license-duration" readonly></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Cơ quan cấp</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-license-by" id="input-license-by" readonly></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Nguồn nước</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-water-source" id="input-water-source" readonly></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Vị trí địa lý</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-location" id="input-location" readonly></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Tọa độ đập chính</div>
                    <div class="col-8 d-flex"><span class="col-2 p-0">X</span><input class="form-control" class="col-10" type="text" name="input-lat-dams" id="input-lat-dams" readonly></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Tọa độ nhà máy</div>
                    <div class="col-8 d-flex"><span class="col-2 p-0">X</span><input class="form-control" class="col-10" type="text" name="input-lat-factory" id="input-lat-factory" readonly></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15"></div>
                    <div class="col-8 d-flex"><span class="col-2 p-0">Y</span><input class="form-control" class="col-10" type="text" name="input-long-dams" id="input-long-dams" readonly></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15"></div>
                    <div class="col-8 d-flex"><span class="col-2 p-0">Y</span><input class="form-control" class="col-10" type="text" name="input-long-factory" id="input-long-factory" readonly></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Chế độ khai thác</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-extraction-mode" id="input-extraction-mode" readonly></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Lượng nước khai thác</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-flow" id="input-flow" readonly></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Phương thức khai thác</div>
                    <div class="col-8"><input class="form-control" type="text" name="input-extraction-method" id="input-extraction-method" readonly></div>
                </div>
            </div>
            <div class="d-flex mt-4">
                <div class="col-6">
                    <button type="button" class="btn btn-success">Sửa</button>
                    <button type="button" class="btn btn-warning mx-2">Cập nhật</button>
                    <button type="button" class="btn btn-danger">Quay lại</button>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('public/js/waterResources.js') }}"></script>
@endsection