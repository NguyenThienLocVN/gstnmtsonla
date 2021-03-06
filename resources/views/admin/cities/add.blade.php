@extends('admin.layout.index')
@section('page_title','Thêm mới đơn vị hành chính')
@section('link_css')
    <link rel="stylesheet" href="{{asset('public/admin/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mới huyện xã
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i>Quản trị</a></li>
            <li><a href="{{route('cities.index')}}">Huyện, xã</a></li>
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
                                <label>Mã huyện/ mã xã (<span class="required">*</span>)</label>
                                <input type="text" class="form-control" placeholder="Nhập mã huyện/ mã xã" name="code"
                                       id="code" value="{{ old('code') }}">
                            </div>
                            @if($errors->has('code'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('code') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Tên (<span class="required">*</span>)</label>
                                <input type="text" class="form-control" placeholder="Nhập tên" name="name"
                                       id="name" value="{{ old('name') }}">
                            </div>
                            @if($errors->has('name'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('name') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Loại (<span class="required">*</span>)</label>
                                <select class="form-control select2 level" name="level" style="width: 100%;">
                                    <option value="">Lựa chọn</option>
                                    <option value="1" @if(old('level') == 1) selected @endif >Huyện</option>
                                    <option value="2" @if(old('level') == 2) selected @endif >Xã</option>
                                </select>
                            </div>
                            @if($errors->has('level'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('level') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Trực thuộc (<span class="required">*</span>)</label>
                                <select class="form-control select2 parent_code"
                                        name="parent_code" style="width: 100%;" disabled>
                                    <option value="">Lựa chọn</option>
                                    @foreach($listCity as $item)
                                        <option value="{{$item->code}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('parent_code'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('parent_code') !!}
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

        $(document).on('change', '.level', function () {
            var level = $(this).val();
            if (level == 1) {
                $('.parent_code').prop('disabled', true);
            } else {
                $('.parent_code').prop('disabled', false);
            }

        });
    </script>
@endsection