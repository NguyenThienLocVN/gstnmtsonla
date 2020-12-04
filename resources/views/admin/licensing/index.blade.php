@extends('admin.layout.index')
@section('page_title','Danh sách cấp phép nước mặt')

@section('custom_css')
    <style>
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh sách cấp phép nước mặt
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Quản trị</a></li>
            <li class="active">Danh sách</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
        @endif
        @if(session('loi'))
            <div class="alert alert-danger">
                {{session('loi')}}
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Tên công trình</th>
                                <th class="text-center">Số GP</th>
                                <th class="text-center">Ngày cấp</th>
                                <th class="text-center">Đơn vị cấp</th>
                                <th class="text-center">Chủ đầu tư</th>
                                <th class="text-center">Huyện</th>
                                <th class="text-center">Xã</th>
                                <th class="text-center">Chế độ khai thác</th>
                                <th class="text-center">Công suất</th>
                                <th class="text-center">Q<sub>max</sub></th>
                                <th class="text-center">Q<sub>TT</sub></th>
                                <th class="text-center">Phương thức khai thác</th>
                                <th class="text-center">Thời hạn</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($licensing as $value)
                                <tr class="text-center">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->construction_name}}</td>
                                    <td>{{$value->license_num}}</td>
                                    <td>{{$value->license_date}}</td>
                                    <td>{{$value->license_by}}</td>
                                    <td>{{$value->investor}}</td>
                                    <td>{{(isset($value['relationsDistrict']->name)) ? $value['relationsDistrict']->name : ""}}</td>
                                    <td>{{(isset($value['relationsDistrict']->name)) ? $value['relationsDistrict']->name : ""}}</td>
                                    <td>{{$value->extraction_mode}}</td>
                                    <td>{{$value->wattage}}</td>
                                    <td>{{$value->max_flow}}</td>
                                    <td>{{$value->q_tt}}</td>
                                    <td>{{$value->extraction_method}}</td>
                                    <td>{{$value->license_duration}}</td>

                                    <td>
                                        <a href="{{route('licensing.edit',['id' => $value->id])}}"
                                           class="btn btn-action label label-success"><i
                                                    class="fa fa-pencil"></i></a>

                                        <a href="{{route('licensing.delete',['id' => $value->id])}}"
                                           onclick="return confirm('Bạn có chắc muốn xóa')"
                                           class="btn btn-action label label-danger"><i
                                                    class="fa fa-trash"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection

@section('script')

    <script>
        $(function () {
            $('#data_table').DataTable({
                // "ordering": false,
                "orderMulti": false,
                "order": [[0, 'desc'], [1, 'false']],
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi mỗi trang",
                    "zeroRecords": "Không tìm thấy bản ghi nào",
                    "info": "Trang _PAGE_ trên _PAGES_",
                    "infoEmpty": "Không có bản ghi nào",
                    "infoFiltered": "(Tìm thấy _TOTAL_ trong _MAX_ sản phẩm)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu tiên",
                        "previous": "Trước",
                        "next": "Sau",
                        "last": "Cuối cùng"
                    }

                }
            })
        })
    </script>
@endsection