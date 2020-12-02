<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class CitiesController extends Controller
{
    public function getIndex()
    {
        $cities = Cities::get();
        $listCity = Cities::where('level', 1)->get()->toArray();
        $arrCity = [];
        $columns = [
            'ID', 'Mã', 'Tên', 'Loại', 'Trực thuộc', 'Thời gian tạo', 'Thời gian cập nhật', 'Hành động',
        ];
        return view('admin.cities.index', compact('cities', 'columns'));
    }

    public function getCreate()
    {
        $listCity = Cities::where('level', 1)->get();
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

        $city = new Cities();
        $city->code = strtoupper($request->code);
        $city->name = $request->name;
        $city->parent_code = $request->parent_code;
        $city->level = $request->level;
        $city->save();

        return redirect('admin/cities/index')->with('thongbao', 'Thêm huyện, xã thành công');

    }

    public function getEdit(Request $request)
    {
        $listCity = Cities::where('level', 1)->get();
        $city = Cities::find($request->id);
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

        $city = Cities::find($request->id);
        $city->code = strtoupper($request->code);
        $city->name = $request->name;
        $city->parent_code = $request->parent_code;
        $city->level = $request->level;
        $city->save();

        return redirect('admin/cities/edit?id=' . $request->id)->with('thongbao', 'Cập nhật huyện, xã thành công');
    }

    public function getDelete(Request $request)
    {
        $city = Cities::find($request->id);
        $city->delete();

        return redirect('admin/cities/index')->with('thongbao', 'Bạn đã xóa thành công');
    }

    /**
     * importDataFile
     * @author Phunght
     * @since 2020/11/30
     */
    public function import()
    {
        $message = '';

        if (isset($_FILES['data_file'])) {
            if (!empty($_FILES['data_file']['name'])) {
                if ($_FILES['data_file']['error'] == 0) {
                    $extension = pathinfo($_FILES['data_file']['name'], PATHINFO_EXTENSION);
                    $allowExtention = array('xlsx', 'xls');
                    if (in_array(strtolower($extension), $allowExtention)) {
                        if ($_FILES['data_file']['size'] <= config('apps.info.max_file_upload_size')) {
                            $current_time = date('YmdHis');
                            $savePath = public_path() . '/excel/' . $current_time . '.' . $extension;
                            if (move_uploaded_file($_FILES['data_file']['tmp_name'], $savePath)) {
                                $message = $this->handleDataFile($savePath);
                                if ($message == "") {
                                    Session::flash('thongbao', 'Import danh sách huyện xã thành công');
                                    return redirect('admin/cities/index');
                                }
                            } else {
                                $message = 'Có lỗi trong quá trình tải file';
                            }
                        } else {
                            $message = 'Kích thước file phải dưới 20MB';
                        }
                    } else {
                        $message = 'File không đúng định dạng';
                    }
                } else {
                    $message = 'File bị lỗi';
                }
            } else {
                $message = 'Chưa chọn file';
            }
        } else {
            return redirect('admin/cities/index');
        }
        Session::flash('loi', $message);
        return redirect('admin/cities/index');
    }

    /**
     * Handle Data File
     * @author Phunght
     * @since 2020/11/30
     */
    public function handleDataFile($filePath)
    {
        $message = '';

        $excelData = [];

        Excel::load(
        /**
         * @param $reader
         */
            $filePath, function ($reader) use (&$excel, $excelData, &$message, &$types, &$gateways, &$status) {
            $objExcel = $reader->getExcel();
            $sheet = $objExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            // Loop through each row of the worksheet in turn
            for ($row = 3; $row <= $highestRow; $row++) {
                // Read a row of data into an array
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                $excelData[] = $rowData[0];
            }
            $fail = 0;
            $error = 0;
            $listErr = [];
            $total = count($excelData);
            if (!empty($excelData)) {
                foreach ($excelData as $data) {
                    $data[0] = trim($data[0]);
                    $data[1] = trim($data[1]);
                    $data[2] = trim($data[2]);
                    $data[3] = trim($data[3]);

                    if (!empty($data[1]) && $data[2]) {
                        $cities = Cities::where('code', $data[1])
                            ->where('name', $data[2])
                            ->first();

                        if (!$cities) {
                            try {
                                $insertCities = new Cities;
                                $insertCities->code = $data[1];
                                $insertCities->name = $data[2];
                                $insertCities->parent_code = $data[3];
                                $insertCities->level = empty($data[3]) ? 1 : 2;
                                $insertCities->created_at = date('Y-m-d H:i:s');
                                $insertCities->updated_at = date('Y-m-d H:i:s');
                                $insertCities->save();
                            } catch (\Exception $e) {
                                Log::info($e->getMessage() . ' - ' . $e->getFile() . ' - ' . $e->getLine());
                            }
                        } else {
                            $error += 1;
                            $text = 'Bản ghi số ' . $data[0] . ' mã ' . $data[1] . ' đã tồn tại';
                            $listErr[] = $text;
                            Log::info('Ban ghi so ' . $data[0] . ' mã ' . $data[1] . ' da ton tai');
                        }
                    }
                }
            }
            if ($fail > 0) {
                $message = $fail . '/' . $total . ' mã đã tồn tại.';
            } elseif ($error > 0) {
                $textErr = implode(', ', $listErr);
                $message = $error . '/' . $total . ' mã đã tồn tại. ' . $textErr;
            }

        });

        Log::info('---------------------------------------------------');
        unlink($filePath);
        return $message;
    }
}
