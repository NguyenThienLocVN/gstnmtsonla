@extends('admin.layout.index')
@section('page_title','Thêm mới cấp phép công trình')
@section('link_css')
    <link rel="stylesheet" href="{{asset('public/admin/bower_components/select2/dist/css/select2.min.css')}}">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
            <img src="{{ asset('public/images/loading.gif') }}" id="loading-gif-image" class="loading-gif position-absolute" alt="loading" style="display: none;">
            <div id="overlay"></div>
                <div class="box-header">
                    <h3 class="box-title">Thêm mới</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tên công trình <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập tên công trình" name="construction_name"
                                       id="construction_name" value="{{ old('construction_name') }}">
                            </div>
                            @if($errors->has('construction_name'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('construction_name') !!}
                                </div>
                            @endif

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Số giấy phép <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập số giấy phép" name="license_num"
                                       id="license_num" value="{{ old('license_num') }}">
                            </div>
                            @if($errors->has('license_num'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('license_num') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ngày cấp <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập ngày cấp" name="license_date"
                                       id="license_date" value="{{ old('license_date') }}">
                            </div>
                            @if($errors->has('license_date'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('license_date') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Đơn vị cấp <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập đơn vị cấp giấy phép" name="license_by"
                                       id="license_by" value="{{ old('license_by') }}">
                            </div>
                            @if($errors->has('license_by'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('license_by') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Chủ đầu tư <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập chủ đầu tư" name="investor"
                                       id="investor" value="{{ old('investor') }}">
                            </div>
                            @if($errors->has('investor'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('investor') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Thời hạn GP (năm) <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Thời hạn" name="license_duration"
                                       id="license_duration" value="{{ old('license_duration') }}">
                            </div>
                            @if($errors->has('license_duration'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('license_duration') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kinh độ đập chính <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập kinh độ đập chính" name="long_dams"
                                       id="long_dams" value="{{ old('long_dams') }}">
                            </div>
                            @if($errors->has('long_dams'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('long_dams') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Vĩ độ đập chính <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập vĩ độ đập chính" name="lat_dams"
                                       id="lat_dams" value="{{ old('lat_dams') }}">
                            </div>
                            @if($errors->has('lat_dams'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('lat_dams') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Huyện <span class="required">*</span></label>
                                <select name="district_code" id="district_code" class="form-control">
                                    <option value="" disabled selected>Chọn huyện ...</option>
                                    @foreach($districts as $district)
                                        <option value="{{$district->code}}" {{(old('district_code') == $district->code) ? "selected" : ""}}>{{$district->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('district_code'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('district_code') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Xã <span class="required">*</span></label>
                                <select name="commune_code" id="commune_code" class="form-control">
                                    <option value="" disabled selected>Chọn xã ...</option>
                                    @foreach($communes as $commune)
                                        <option value="{{$commune->code}}" {{(old('commune_code') == $commune->code) ? "selected" : ""}}>{{$commune->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('commune_code'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('commune_code') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Kinh độ nhà máy <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập kinh độ nhà máy" name="long_factory"
                                       id="long_factory" value="{{ old('long_factory') }}">
                            </div>
                            @if($errors->has('long_factory'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('long_factory') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Vĩ độ nhà máy <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập vĩ độ nhà máy"  name="lat_factory"
                                       id="lat_factory" value="{{ old('lat_factory') }}">
                            </div>
                            @if($errors->has('lat_factory'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('lat_factory') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nguồn nước <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập nguồn nước"  name="water_source"
                                       id="water_source" value="{{ old('water_source') }}">
                            </div>
                            @if($errors->has('water_source'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('water_source') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Chế độ khai thác <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập chế độ khai thác" name="extraction_mode"
                                       id="extraction_mode" value="{{ old('extraction_mode') }}">
                            </div>
                            @if($errors->has('extraction_mode'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('extraction_mode') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Phương thức khai thác <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập phương thức khai thác" name="extraction_method"
                                       id="extraction_method" value="{{ old('extraction_method') }}">
                            </div>
                            @if($errors->has('extraction_method'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('extraction_method') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Công suất (MW) <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập công suất" name="wattage"
                                       id="wattage" value="{{ old('wattage') }}">
                            </div>
                            @if($errors->has('wattage'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('wattage') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dòng chảy tối đa (m<sup>3</sup>/s) <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập dòng chảy tối đa" name="max_flow"
                                       id="max_flow" value="{{ old('max_flow') }}">
                            </div>
                            @if($errors->has('max_flow'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('max_flow') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dòng chảy tối thiểu (m<sup>3</sup>/s) <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="Nhập dòng chảy tối thiểu" name="min_flow"
                                       id="min_flow" value="{{ old('min_flow') }}">
                            </div>
                            @if($errors->has('min_flow'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('min_flow') !!}
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
            $('#district_code').select2();
            $('#district_code').on('select2:select',function(e){
                $('#commune_code').empty();
                // AJAX request load construction when select district
                $.ajax({
                    url: window.location.origin+'/tai-nguyen-nuoc/district/'+e.params.data.id,
                    type: 'get',
                    dataType: 'json',
                    beforeSend: function(){
                        $("#loading-gif-image").show();
                        $("#overlay").show();
                    },
                    success: function(response){
                        $("#loading-gif-image").hide();
                        $("#overlay").hide();

                        // Load communes
                        var defaultCommuneOption = "<option value='' >Chọn xã..</option>";
                        $("#commune_code").append(defaultCommuneOption);
                        for(var i=0; i < response.communes.length; i++)
                        {
                            var option = "<option value='"+response.communes[i].code+"'>"+response.communes[i].name+"</option>";
                            $("#commune_code").append(option);
                        }
                    }
                }); 
            })

            $('#commune_code').select2();
            $("#license_date").datepicker();
            $("#license_date").datepicker( "option", "dateFormat", "dd/mm/yy");
        })

    </script>
@endsection