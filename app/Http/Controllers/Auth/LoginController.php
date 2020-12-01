<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Users;
use App\Models\Offices;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLogin()
    {
        $offices = DB::table('offices')->join('users', 'users.office_id', '=', 'offices.id')->get();
        return view('auth.login',['offices'=>$offices]);
    }
    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
  
        $user = Users::where('username', $input['username'])->first();
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if($user->status == 1)
        {
            if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
            {
                return redirect()->route('index');
            }
            else{
                return redirect()->route('login')
                    ->withErrors('Đăng nhập thất bại. Vui lòng kiểm tra lại tài khoản!');
            }
        }
        else{
            return redirect()->route('login')
                ->withErrors('Vui lòng liên hệ quản trị viên để xét duyệt tài khoản!');
        }
          
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
    
}
