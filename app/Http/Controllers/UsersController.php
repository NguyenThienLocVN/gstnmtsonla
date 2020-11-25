<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Users;
use App\Offices;
use App\Roles;
use DB;
use Auth;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userManager()
    {
        $users = DB::table('users')->join("offices","offices.id","=","users.office_id")
        ->join("roles","roles.id","=","users.role_id")
        ->select('users.*', 'offices.*', 'roles.*', 'users.id as userID' )
        ->get();
        return view('pages.tai-nguyen-nuoc.nguoi-dung.quan-ly-nguoi-dung',["users"=>$users]);
    }
    public function infoUser()
    {
        $fullname = Auth::user()->fullname;
        $email = Auth::user()->email;
        $phone = Auth::user()->phone;
        $office = Offices::where('id',Auth::user()->office_id)->first();
        $role = Roles::where('id',Auth::user()->role_id)->first();
        return view('pages.tai-nguyen-nuoc.nguoi-dung.thong-tin-nguoi-dung',["fullname"=>$fullname,"email"=>$email,"phone"=>$phone,"office"=>$office,"role"=>$role]);
    }
    public function showUpdatePassword()
    {
        return view('pages.tai-nguyen-nuoc.nguoi-dung.update-password');
    }
    public function updatePassword(Request $request, Users $user)
    {
        $this->validate($request, [
            'current_password'=>'required',
            'new_password'=>'required|min:6',
            'confirm_password'=>'required|same:new_password',
        ],[
            'current_password.required'=>'Ở đây bạn không được để rỗng !',
            'new_password.required'=>'Ở đây bạn không được để rỗng !',
            'confirm_password.required'=>'Ở đây bạn không được để rỗng !',
            'confirm_password.same'=>'Xác nhận mật khẩu phải giống với mật khẩu mới !',
        ]);
        $data = $request->all();
        if(!Hash::check($data['current_password'], Auth::user()->password)){
            return redirect()->back()->withErrors(['current_password'=>'Bạn nhập sai mật khẩu hiện tại. Hãy thử lại !']);
        }else{
            $user = Auth::user();
            $user->password = bcrypt($request->get('new_password'));
            $user->save();
            return redirect('tai-nguyen-nuoc/nguoi-dung/thong-tin-nguoi-dung')->with('success','Bạn đổi mật khẩu thành công !');
        }
    }

    public function activeUser($id){
        $user = Users::find($id);
        $user->status = 1;
        $user->save();
        return redirect()->back()->with('message','Operation Successful !');
    }
}
