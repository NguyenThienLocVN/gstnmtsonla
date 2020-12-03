<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cities;
use App\Models\Licenses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $listCity = Cities::where('level', 1)->get();
        return view('admin.licensing.add', compact('listCity'));
    }

    public function postCreate(Request $request)
    {


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
