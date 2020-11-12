@section('title', 'Số liệu khí tượng | Hệ thống quản lý, lưu trữ thông tin, dữ liệu khí tượng thủy văn')
@extends('layouts.base')

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/pdfmake@latest/build/pdfmake.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/pdfmake@latest/build/vfs_fonts.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/html-to-pdfmake/docs/browser.js"></script>
    <script src="{{asset('public/js/meteorology.js')}}"></script>
@endpush

@section('content')
<main class="main-welcom container-fluid p-0 position-relative">
    <div class="text-center w-100 bg-light">
        <h6 class="p-2 font-weight-bold top-title">HỆ THỐNG QUẢN LÝ, LƯU TRỮ THÔNG TIN, DỮ LIỆU KHÍ TƯỢNG THỦY VĂN</h6>
    </div>
    @include('layouts.navigation-thuy-van')
    <div class="wrap-content w-100 meteorology-data">
        <div class="w-100 head-intro">
            <p class="px-2 py-1 mt-2 font-weight-bold text-white">Số liệu khí tượng</p>
        </div>
        <table class="list-station w-100 mt-3">
            <thead>
                <tr class="row-station text-center text-white">
                    <th class="item py-2">STT</th>
                    <th class="item py-2">Tên trạm</th>
                    <th class="item py-2">Mã trạm</th>
                    <th class="item py-2">Loại trạm</th>
                    <th class="item py-2">Kinh độ</th>
                    <th class="item py-2">Vĩ độ</th>
                    <th class="item py-2">Độ cao tương đối (m)</th>
                    <th class="item py-2">Độ cao tuyệt đối</th>
                    <th class="item py-2">Thời gian bắt đầu</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td class="item py-2">1</td>
                    <td class="item py-2">Yên Châu</td>
                    <td class="item py-2">M01</td>
                    <td class="item py-2">2</td>
                    <td class="item py-2">107o11'</td>
                    <td class="item py-2">11o44'</td>
                    <td class="item py-2">946</td>
                    <td class="item py-2"></td>
                    <td class="item py-2">1972 - nay</td>
                    <td><button class="btn-view-detail" data-toggle="modal" data-target="#meteorologyModal" onClick="loadMeteorology(3)" title="Xem chi tiết"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                </tr>
                <tr class="text-center">
                    <td class="item py-2">2</td>
                    <td class="item py-2">Bắc Yên</td>
                    <td class="item py-2">M02</td>
                    <td class="item py-2">2</td>
                    <td class="item py-2">107o52'</td>
                    <td class="item py-2">12o05'</td>
                    <td class="item py-2">1235</td>
                    <td class="item py-2"></td>
                    <td class="item py-2">1980 - nay</td>
                    <td><button class="btn-view-detail" data-toggle="modal" data-target="#meteorologyModal" onClick="loadMeteorology(3)" title="Xem chi tiết"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                </tr>
                <tr class="text-center">
                    <td class="item py-2">3</td>
                    <td class="item py-2">Thuận Châu</td>
                    <td class="item py-2">M03</td>
                    <td class="item py-2">1</td>
                    <td class="item py-2">106o12</td>
                    <td class="item py-2">11o44'</td>
                    <td class="item py-2">985</td>
                    <td class="item py-2"></td>
                    <td class="item py-2">1972 - 2016</td>
                    <td><button class="btn-view-detail" data-toggle="modal" data-target="#meteorologyModal" onClick="loadMeteorology(3)" title="Xem chi tiết"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                </tr>
                <tr class="text-center">
                    <td class="item py-2">4</td>
                    <td class="item py-2">Mộc Châu</td>
                    <td class="item py-2">M04</td>
                    <td class="item py-2">1</td>
                    <td class="item py-2">108o22'</td>
                    <td class="item py-2">10o27'</td>
                    <td class="item py-2">1157</td>
                    <td class="item py-2"></td>
                    <td class="item py-2">1972 - nay</td>
                    <td><button class="btn-view-detail" data-toggle="modal" data-target="#meteorologyModal" onClick="loadMeteorology(3)" title="Xem chi tiết"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <img src="{{ asset('public/images/loading.gif') }}" id="loading-gif-image" class="loading-gif position-absolute" alt="loading" style="display: none;">
    
    <!-- Well begun is half done. - Aristotle -->
    <div class="modal fade" id="meteorologyModal" tabindex="-1" role="dialog" aria-labelledby="meteorologyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="overlay"></div>
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-white" id="meteorologyModalLabel">TỔNG HỢP SỐ LIỆU KHÍ TƯỢNG TRẠM Yên Châu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="space-wrapper d-flex">
                        <div class="statistical-space position-relative mr-2" id="statistical-space">
                            <div class="meteorology-info" id="meteorology-info">
                                <div class="basic-info py-2">
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Tên trạm : </div>
                                        <div class="col-5 font-weight-bold"><span id="meteorology-station-value">Yên Châu</span></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Mã trạm : </div>
                                        <div class="col-5 font-weight-bold">MS1</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Vĩ độ : </div>
                                        <div class="col-5 font-weight-bold"><span id="meteorology-latitude-value">11o44'</span></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Kinh độ : </div>
                                        <div class="col-5 font-weight-bold"><span id="meteorology-longitude-value">107o11'</span></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Sông : </div>
                                        <div class="col-5 font-weight-bold"><span id="meteorology-river-value"></span></div>
                                    </div>
                                </div>
                                <div class="monitoring-info py-2">
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Thời gian quan trắc : &nbsp; <i class="fa fa-info-circle wet-info" aria-hidden="true" data-toggle="season-info" data-trigger="hover" data-content="Số liệu bên dưới áp dụng khi NGÀY BẮT ĐẦU và NGÀY KẾT THÚC cùng 1 năm"></i></div>
                                        <div class="col-5 font-weight-bold"><span id="meteorology-monitoring-time"></span></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7 pr-0">TB <span class="year-value"></span> : </div>
                                        <div class="col-5 font-weight-bold"><span class="same-year-value" id="meteorology-average-value"></span> g/m<sup>3</sup></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Lớn nhất <span class="year-value"></span> : </div>
                                        <div class="col-5 font-weight-bold"><span class="same-year-value" id="meteorology-max-value"></span> g/m<sup>3</sup></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Ngày xuất hiện : </div>
                                        <div class="col-5 font-weight-bold"><span class="same-year-value" id="meteorology-max-date"></span></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7"></div>
                                        <div class="col-5 font-weight-bold"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7"></div>
                                        <div class="col-5 font-weight-bold"></div>
                                    </div>
                                </div>
                                <div class="wet-season py-2">
                                    <div class="d-flex justify-content-between mb-1 position-relative">
                                        <div class="col-7 wet-season-title"><span>MÙA MƯA</span></div>
                                        <div class="col-5"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Lớn nhất : </div>
                                        <div class="col-5 font-weight-bold"><span class="same-year-value" id="meteorology-wet-season-max-value"></span> g/m<sup>3</sup></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Ngày xuất hiện : </div>
                                        <div class="col-5 font-weight-bold"><span class="same-year-value" id="meteorology-wet-season-max-date"></span></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <div class="col-7"></div>
                                        <div class="col-5 font-weight-bold"></div>
                                    </div>
                                </div>
                                <div class="dry-season py-2">
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7 dry-season-title">MÙA KHÔ </div>
                                        <div class="col-5 font-weight-bold"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Lớn nhất : </div>
                                        <div class="col-5 font-weight-bold"><span class="same-year-value" id="meteorology-dry-season-max-value"></span> g/m<sup>3</sup></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7">Ngày xuất hiện : </div>
                                        <div class="col-5 font-weight-bold"><span class="same-year-value" id="meteorology-dry-season-max-date"></span></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7"></div>
                                        <div class="col-5 font-weight-bold"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="col-7"></div>
                                        <div class="col-5 font-weight-bold"></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn-success position-absolute btn-export" id="btn-export-station-info" title="Xuất thông tin" onclick="toPdf()"><i class="fa fa-download" aria-hidden="true"></i></button>
                            
                        </div>
                        <div class="chart-space position-relative" id="chart-space">
                            <div class="date-range d-flex mb-2 pl-4 align-items-center font-13">
                                <div class="d-flex align-items-center" id="block-start">
                                    <span class="mr-1">Từ ngày</span>
                                    <input data-date-format="dd/mm/yyyy" class="mr-1 start-picker" id="meteorology-start-picker" style="height: 25px;">
                                </div>
                                <div class="d-flex align-items-center" id="block-end">
                                    <span class="mr-1">Đến ngày</span>
                                    <input data-date-format="dd/mm/yyyy" class="mr-1 end-picker" id="meteorology-end-picker" style="height: 25px;">
                                </div>
                                <div class="d-flex">
                                    <input type="button" value="Tìm kiếm" class="search-btn" id="search-rain-btn">
                                </div>
                            </div>
                            
                            <div class="position-relative" id="block-export">
                                <div id="meteorology-container" style="width:100%; height:300px;"></div>
                                <button class="btn btn-primary position-absolute" id="btn-show-download" title="Xuất file biểu đồ"><i class="fa fa-download" aria-hidden="true"></i></button>
                                <button class="d-none position-absolute btn-success border-0 rounded border-success small" id="btn-export-png">Xuất PNG</button>
                                <button class="d-none position-absolute btn-success border-0 rounded border-success small" id="btn-export-xls">Xuất XLS</button>
                            </div>
                            
                            <div class="position-relative">
                                <div id="meteorology-max-chart" class="max-chart turbidity-ele" style="width:100%; height:200px;"></div>
                                <div id="meteorology-date-max-appear" class="meteorology-date-max-appear date-max-appear date-appear font-13 position-absolute w-100">
                                    <table border=1 class="text-center w-100 table-date-max-appear">
                                        <tr>
                                            <td>Ngày</td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                            <td class="date"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="position-relative">
                                <div id="meteorology-avg-chart" class="avg-chart turbidity-ele" style="width:100%; height:200px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="{{ asset('public/js/main.js') }}"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>

@endsection