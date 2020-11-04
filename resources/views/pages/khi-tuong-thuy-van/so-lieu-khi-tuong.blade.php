@section('title', 'Số liệu khí tượng | Hệ thống quản lý, lưu trữ thông tin, dữ liệu khí tượng thủy văn')
@extends('layouts.base')

@section('content')
<main class="main-welcom container-fluid p-0 position-relative">
    <div class="text-center w-100 bg-light">
        <h6 class="p-2 font-weight-bold top-title">HỆ THỐNG QUẢN LÝ, LƯU TRỮ THÔNG TIN, DỮ LIỆU KHÍ TƯỢNG THỦY VĂN</h6>
    </div>
    @include('layouts.navigation-hydrological')
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
                    <th class="item py-2">1972 - nay</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td class="item py-2">1</td>
                    <td class="item py-2">Yên Châu</td>
                    <td class="item py-2">M01</td>
                    <td class="item py-2">2</td>
                    <td class="item py-2">107o11'03"</td>
                    <td class="item py-2">11o44'</td>
                    <td class="item py-2">946</td>
                    <td class="item py-2"></td>
                    <td class="item py-2">Thời gian bắt đầu</td>
                    <td></td>
                </tr>
                <tr class="text-center">
                    <td class="item py-2">2</td>
                    <td class="item py-2">Bắc Yên</td>
                    <td class="item py-2">M02</td>
                    <td class="item py-2">2</td>
                    <td class="item py-2">107o52'24"</td>
                    <td class="item py-2">12o05'</td>
                    <td class="item py-2">1235</td>
                    <td class="item py-2"></td>
                    <td class="item py-2">1980 - nay</td>
                    <td></td>
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
                    <td></td>
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
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    

</main>

@endsection