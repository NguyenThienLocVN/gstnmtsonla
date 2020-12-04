<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cities;
use App\Models\Licenses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class LicensingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $licensing = Licenses::with(['relationsDistrict'])->with(['relationsCommune'])->where('status',1)->get();
        $columns = [
            'ID', 'Tên công trình', 'Số giấy phép', 'Ngày cấp', 'Đơn vị cấp', 'Chủ đầu tư', 'Huyện', 'Xã', 'Kinh độ đập chính', 'Vĩ độ đập chính', 'Kinh độ nhà máy', 'Vĩ độ nhà máy', 'Nguồn nước', 'Chế độ khai thác', 'Công suất lắp máy', 'Lưu lượng lớn nhất', 'Lưu lượng tối thiểu', 'Phương thức khai thác', 'Thời hạn',  'Hành động'
        ];
        return view('admin.licensing.index', compact('licensing', 'columns'));
    }

    public function getCreate()
    {
        $districts = Cities::where('level', 1)->get();
        $communes = Cities::where('level', 2)->get();
        return view('admin.licensing.add', compact('districts', 'communes'));
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'construction_name' => 'required',
            'license_num' => 'required|numeric|unique:licenses,license_num',
            'license_date' => 'required|date',
            'license_by' => 'required',
            'investor' => 'required',
            'district_code' => 'required',
            'commune_code' => 'required',
            'long_dams' => 'required|numeric',
            'lat_dams' => 'required|numeric',
            'long_factory' => 'required|numeric',
            'lat_factory' => 'required|numeric',
            'water_source' => 'required',
            'extraction_mode' => 'required',
            'wattage' => 'required|numeric',
            'max_flow' => 'required|numeric',
            'min_flow' => 'required|numeric',
            'extraction_method' => 'required',
            'license_duration' => 'required|numeric'
        ];
        $message = [
            'construction_name.required' => 'Bạn chưa nhập tên công trình',
            'license_num.required' => 'Bạn chưa nhập mã giấy phép',
            'license_num.numeric' => 'Mã không hợp lệ',
            'license_num.unique' => 'Mã giấy phép đã tồn tại',
            'license_date.required' => 'Bạn chưa nhập ngày cấp',
            'license_date.date' => 'Ngày cấp không hợp lệ',
            'license_by.required' => 'Bạn chưa nhập đơn vị cấp',
            'investor.required' => 'Bạn chưa nhập tên chủ đầu tư',
            'district_code.required' => 'Bạn chưa chọn huyện',
            'commune_code.required' => 'Bạn chưa chọn xã',
            'long_dams.required' => 'Bạn chưa nhập kinh độ',
            'long_dams.numeric' => 'Giá trị kinh độ không hợp lệ',
            'lat_dams.required' => 'Bạn chưa nhập vĩ độ',
            'lat_dams.numeric' => 'Giá trị vĩ độ không hợp lệ',
            'long_factory.required' => 'Bạn chưa nhập kinh độ',
            'long_factory.numeric' => 'Giá trị kinh độ không hợp lệ',
            'lat_factory.required' => 'Bạn chưa nhập vĩ độ',
            'lat_factory.numeric' => 'Giá trị vĩ độ không hợp lệ',
            'water_source.required' => 'Bạn chưa nhập nguồn nước',
            'extraction_mode.required' => 'Bạn chưa nhập chế độ khai thác',
            'wattage.required' => 'Bạn chưa nhập công suất',
            'wattage.numeric' => 'Công suất không hợp lệ',
            'max_flow.required' => 'Bạn chưa nhập dòng chảy tối đa',
            'max_flow.numeric' => 'Dòng chảy tối đa không hợp lệ',
            'min_flow.required' => 'Bạn chưa nhập dòng chảy tối thiểu',
            'min_flow.numeric' => 'Dòng chảy tối thiểu không hợp lệ',
            'extraction_method.required' => 'Bạn chưa nhập chế độ khai thác',
            'license_duration.required' => 'Bạn chưa nhập thời hạn giấy phép',
            'license_duration.numeric' => 'Thời hạn giấy phép không hợp lệ',
        ];
        $this->validate($request,$rules, $message);

        $license = new Licenses();
        $license->construction_name = $request->construction_name;
        $license->license_num = $request->license_num;
        $license->license_date = Carbon::parse($request->license_date);
        $license->license_by = $request->license_by;
        $license->investor = $request->investor;
        $license->district_code = $request->district_code;
        $license->commune_code = $request->commune_code;
        $license->long_dams = $request->long_dams;
        $license->lat_dams = $request->lat_dams;
        $license->long_factory = $request->long_factory;
        $license->lat_factory = $request->lat_factory;
        $license->water_source = $request->water_source;
        $license->extraction_mode = $request->extraction_mode;
        $license->wattage = $request->wattage;
        $license->max_flow = $request->max_flow;
        $license->min_flow = $request->min_flow;
        $license->extraction_method = $request->extraction_method;
        $license->license_duration = $request->license_duration;
        $license->save();

        return redirect('admin/licensing/index')->with('thongbao', 'Thêm công trình thành công');

    }

    public function getEdit(Request $request)
    {

    }

    public function postEdit(Request $request)
    {

    }

    public function getDelete(Request $request)
    {
        $city = Licenses::find($request->id);
        $city->delete();

        return redirect('admin/licensing/index')->with('thongbao', 'Bạn đã xóa thành công');
    }
}
