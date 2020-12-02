<?php

namespace App\Http\Controllers\Admin;

use App\Models\Licenses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicensingController extends Controller
{
    public function getIndex()
    {
        $licensing = Licenses::get();
        $columns = [
            'ID', 'Tên công trình', 'Số giấy phép', 'Ngày cấp', 'Đơn vị cấp	Chủ đầu tư', 'Huyện', 'Xã', 'Kinh độ đập chính', 'Vĩ độ đập chính', 'Kinh độ nhà máy', 'Vĩ độ nhà máy', 'Nguồn nước', 'Chế độ khai thác', 'Công suất lắp máy', 'Lưu lượng lớn nhất', 'Phương thức khai thác', 'Thời hạn', 'Lưu lượng tối thiểu', 'Thời gian tạo', 'Thời gian cập nhật', 'Hành động'
        ];
        return view('admin.cities.index', compact('cities', 'columns'));
    }

    public function getCreate()
    {
        $listCity = Licenses::where('level', 1)->get();
        return view('admin.cities.add', compact('listCity'));
    }

    public function postCreate(Request $request)
    {
        $rules = [
            'code' => 'required|min:3|max:10|unique:cities,code',
            'name' => 'required',
            'level' => 'required',
        ];
        $message = [
            'code.required' => 'Bạn chưa nhập mã',
            'code.min' => 'Mã phải có độ dài ít nhất 3 ký tự',
            'code.max' => 'Mã chỉ có độ dài đến 10 ký tự',
            'code.unique' => 'Mã đã tồn tại',
            'name.required' => 'Bạn chưa nhập tên',
            'level.required' => 'Bạn chưa chọn loại',
        ];
        if ($request->level == 2) {
            $rules['parent_code'] = 'required';
            $message['parent_code.required'] = "Bạn chưa chọn trực thuộc";
        }
        $this->validate($request,$rules, $message);

        $city = new Licenses();
        $city->code = strtoupper($request->code);
        $city->name = $request->name;
        $city->parent_code = $request->parent_code;
        $city->level = $request->level;
        $city->save();

        return redirect('admin/cities/index')->with('thongbao', 'Thêm huyện, xã thành công');

    }

    public function getEdit(Request $request)
    {
        $listCity = Licenses::where('level', 1)->get();
        $city = Licenses::find($request->id);
        return view('admin.cities.edit', compact('listCity', 'city'));
    }

    public function postEdit(Request $request)
    {
        $this->validate($request,
            [
                'code' => 'required|min:3|max:10|unique:cities,code,' . $request->id,
                'name' => 'required',
                'level' => 'required',
            ],
            [
                'code.required' => 'Bạn chưa nhập mã',
                'code.min' => 'Mã phải có độ dài ít nhất 3 ký tự',
                'code.max' => 'Mã chỉ có độ dài đến 10 ký tự',
                'code.unique' => 'Mã đã tồn tại',
                'name.required' => 'Bạn chưa nhập tên',
                'level.required' => 'Bạn chưa chọn loại',
            ]);

        $city = Licenses::find($request->id);
        $city->code = strtoupper($request->code);
        $city->name = $request->name;
        $city->parent_code = $request->parent_code;
        $city->level = $request->level;
        $city->save();

        return redirect('admin/cities/edit?id=' . $request->id)->with('thongbao', 'Cập nhật huyện, xã thành công');
    }

    public function getDelete(Request $request)
    {
        $city = Licenses::find($request->id);
        $city->delete();

        return redirect('admin/cities/index')->with('thongbao', 'Bạn đã xóa thành công');
    }
}
