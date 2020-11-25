@section('title', 'Giám sát hồ thủy điện trên 2MW')
@extends('layouts.base-wr')

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
   <script src="https://unpkg.com/esri-leaflet@2.5.0/dist/esri-leaflet.js" integrity="sha512-ucw7Grpc+iEQZa711gcjgMBnmd9qju1CICsRaryvX7HJklK0pGl/prxKvtHwpgm5ZHdvAil7YPxI1oWPOWK3UQ==" crossorigin=""></script>
@endpush
@section('content')
    <div class="wrap-content w-100 position-relative">
        <div class="content-left float-left position-relative">
            <img src="{{ asset('public/images/loading.gif') }}" id="loading-gif-image" class="loading-gif position-absolute" alt="loading" style="display: none;">
            <div id="overlay"></div>
            <div class="d-flex p-2 base-bgcolor ">
                <div>
                    <span href="" class="text-white" id="toggle-sidebar" title="Mở rộng menu"><i class="fa fa-expand" aria-hidden="true"></i></span>
                </div>
                <div class="text-center col-11">
                    <b class="text-white">HỒ CHỨA THỦY ĐIỆN TRÊN 2MW</b>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between my-2">
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

            <div class="col-12 d-flex my-2">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active px-2 py-1" id="nav-reservoir-tab" data-toggle="tab" href="#nav-reservoir" role="tab" aria-controls="nav-reservoir" aria-selected="true">Thông tin hồ chứa</a>
                        <a class="nav-item nav-link px-2 py-1" id="nav-specification-tab" data-toggle="tab" href="#nav-specification" role="tab" aria-controls="nav-specification" aria-selected="false">Thông số kỹ thuật</a>
                    </div>
                </nav>
            </div>
            <div class="col-12 d-flex">
                <div class="tab-content w-100" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-reservoir" role="tabpanel" aria-labelledby="nav-reservoir-tab">
                        <div class="d-flex align-items-center my-1">
                            <div class="col-4 pl-0"><button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Sửa</button></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Công trình</p></div>
                            <div class="col-8 p-0"><p class="text-dark">Nậm Pia</p></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Số GP</p></div>
                            <div class="col-8 p-0"><p class="text-dark">482 / GP-BTNMT cấp ngày 10/09/2019</p></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Chủ đầu tư</p></div>
                            <div class="col-8 p-0"><p class="text-dark">Công ty Cổ phần Thủy điện Nậm Pia</p></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Nguồn nước</p></div>
                            <div class="col-8 p-0"><p class="text-dark">Suối Nậm Pia</p></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Vị trí địa lý</p></div>
                            <div class="col-8 p-0"><p class="text-dark">xã Ngọc Chiến, huyện Mường La</p></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Tọa độ đập chính</p></div>
                            <div class="col-8 p-0"><span class="col-6 pl-0 font-14">X : 476744 </span><span class="col-6 font-14"> Y : 2373283</span></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Tọa độ nhà máy</p></div>
                            <div class="col-8 p-0"><span class="col-6 pl-0 font-14">X : 476744 </span><span class="col-6 font-14"> Y : 2373283</span></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Chế độ khai thác</p></div>
                            <div class="col-8 p-0"><p class="text-dark">Điều tiết ngày đêm</p></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Lượng nước khai thác</p></div>
                            <div class="col-8 p-0"><p class="text-dark">Công suất lắp máy: 10MW</p></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold"></p></div>
                            <div class="col-8 p-0"><p class="text-dark">Lưu lượng lớn nhất: 7,9 m3/s</p></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Thời hạn GP</p></div>
                            <div class="col-8 p-0"><p class="text-dark">10 năm</p></div>
                        </div>
                        <div class="d-flex align-items-center my-1 info-item">
                            <div class="col-4 pl-0"><p class="text-dark font-weight-bold">Duy trì</p></div>
                            <div class="col-8 p-0"><p class="text-dark">Bảo đảm duy trì lượng xả thường xuyên, liên tục sau đập không nhỏ hơn 0,4 m3/s và tổng lưu lượng xả trung bình ngày không nhỏ hơn 0,79 m3/s</p></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-specification" role="tabpanel" aria-labelledby="nav-specification-tab">TSKT</div>
                </div>
            </div>

            <div class="col-12 d-flex my-3">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-observe-tab" data-toggle="tab" href="#nav-observe" role="tab" aria-controls="nav-observe" aria-selected="true">Giám sát</a>
                        <a class="nav-item nav-link" id="nav-operate-tab" data-toggle="tab" href="#nav-operate" role="tab" aria-controls="nav-operate" aria-selected="false">Vận hành</a>
                    </div>
                </nav>
            </div>
            <div class="col-12 d-flex">
                <div class="tab-content tab-observe w-100" id="nav-tabContent">
                    <div class="tab-pane fade show active observe-block" id="nav-observe" role="tabpanel" aria-labelledby="nav-observe-tab">
                        <div class="d-flex text-center">
                            <div class="col-3 px-1">
                                <p class="font-weight-bold mb-1">Mực nước</p>
                                <div class="d-flex justify-content-center align-items-end"><b class="text-danger">2</b>&nbsp; <div class="d-flex flex-column"><img class="flat-icon" src="{{ asset('public/images/icon/water-level-icon.png') }}" alt="raining-icon"><span>hồ </span></div></div>
                            </div>
                            <div class="col-3 px-1">
                                <p class="font-weight-bold mb-1">Q<sub>TT</sub></p>
                                <div class="d-flex justify-content-center align-items-end"><b class="text-danger">0</b>&nbsp; <div class="d-flex flex-column"><img class="flat-icon" src="{{ asset('public/images/icon/capacity.png') }}" alt="raining-icon"><span>hồ </span></div></div>
                            </div>
                            <div class="col-3 px-1">
                                <p class="font-weight-bold mb-1">Q<sub>xả NM</sub></p>
                                <div class="d-flex justify-content-center align-items-end"><b class="text-danger">2</b>&nbsp; <div class="d-flex flex-column"><img class="flat-icon" src="{{ asset('public/images/icon/river-icon.jpg') }}" alt="raining-icon"><span>hồ </span></div></div>
                            </div>
                            <div class="col-3 px-1">
                                <p class="font-weight-bold mb-1">Q<sub>xả tràn</sub></p>
                                <div class="d-flex justify-content-center align-items-end"><b class="text-danger">2</b>&nbsp; <div class="d-flex flex-column"><img class="flat-icon" src="{{ asset('public/images/icon/lake-icon.png') }}" alt="raining-icon"><span>hồ </span></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-operate" role="tabpanel" aria-labelledby="nav-operate-tab">TSKT</div>
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
        <div class="content-right float-right position-relative">
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


    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-white font-15" id="editModalLabel">CHỈNH SỬA THÔNG TIN TRẠM</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="d-flex">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Tên công trình</div>
                    <div class="col-8 position-relative"><input class="form-control" type="text" name="edit-construction-name" class="edit-construction-name"></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Chủ đầu tư</div>
                    <div class="col-8 w-100"><input class="form-control" type="text" name="edit-construction-name"></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Số GP</div>
                    <div class="col-8"><input class="form-control" type="text" name="edit-construction-name"></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Ngày cấp</div>
                    <div class="col-8"><input class="form-control" type="text" name="edit-construction-name"></div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Thời hạn GP</div>
                    <div class="col-8"><input class="form-control" type="text" name="edit-construction-name"></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Cơ quan cấp</div>
                    <div class="col-8"><input class="form-control" type="text" name="edit-construction-name"></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Nguồn nước</div>
                    <div class="col-8"><input class="form-control" type="text" name="edit-construction-name"></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Vị trí địa lý</div>
                    <div class="col-8"><input class="form-control" type="text" name="edit-construction-name"></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Tọa độ đập chính</div>
                    <div class="col-8 d-flex"><span class="col-2 p-0">X</span><input class="form-control" class="col-10" type="text" name="edit-construction-name"></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Tọa độ nhà máy</div>
                    <div class="col-8 d-flex"><span class="col-2 p-0">X</span><input class="form-control" class="col-10" type="text" name="edit-construction-name"></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15"></div>
                    <div class="col-8 d-flex"><span class="col-2 p-0">Y</span><input class="form-control" class="col-10" type="text" name="edit-construction-name"></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15"></div>
                    <div class="col-8 d-flex"><span class="col-2 p-0">Y</span><input class="form-control" class="col-10" type="text" name="edit-construction-name"></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Chế độ khai thác</div>
                    <div class="col-8"><input class="form-control" type="text" name="edit-construction-name"></div>
                </div>
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Lượng nước khai thác</div>
                    <div class="col-8"><input class="form-control" type="text" name="edit-construction-name"></div>
                </div>
            </div>
            <div class="d-flex my-2">
                <div class="col-6 d-flex">
                    <div class="col-4 p-0 font-weight-bold font-15">Duy trì</div>
                    <div class="col-8"><textarea class="form-control" type="text" name="edit-construction-name"></textarea></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary">Cập nhật</button>
        </div>
        </div>
    </div>
    </div>
<script src="{{ asset('public/js/configMap.js') }}"></script>
<script src="{{ asset('public/js/waterResources.js') }}"></script>
@endsection