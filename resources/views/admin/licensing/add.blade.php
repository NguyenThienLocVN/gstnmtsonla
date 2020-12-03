@extends('admin.layout.index')
@section('page_title','Thêm mới')
@section('link_css')
    <link rel="stylesheet" href="{{asset('public/admin/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mới cấp phép
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i>Quản trị</a></li>
            <li><a href="{{route('licensing.index')}}">Cấp phép</a></li>
            <li class="active">Thêm mới</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
        @endif
        <form action="" method="POST" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Thêm mới</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên công trình (<span class="required">*</span>)</label>
                                <input type="text" class="form-control" placeholder="Nhập tên công trình" name="construction_name"
                                       id="construction_name" value="{{ old('construction_name') }}">
                            </div>
                            @if($errors->has('construction_name'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('construction_name') !!}
                                </div>
                            @endif

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Số giấy phép (<span class="required">*</span>)</label>
                                <input type="text" class="form-control" placeholder="Nhập số giấy phép" name="license_num"
                                       id="license_num" value="{{ old('license_num') }}">
                            </div>
                            @if($errors->has('license_num'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('license_num') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="center-block max-width-content">
                        <button type="submit" class="btn btn-primary" style="margin-right: 10px">Lưu</button>
                        <button type="reset" class="btn btn-warning ">Làm lại</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <!-- Select2 -->
    <script src="{{asset('public/admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        })

    </script>
@endsection