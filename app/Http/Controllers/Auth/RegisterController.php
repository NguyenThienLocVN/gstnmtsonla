<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'username' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
            'phone' => ['required', 'numeric'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'organization' => $data['organization'],
        ]);
    }

    protected function doRegister(){
        $user = new User;
        $user->fullname = Input::get('fullname');
        $user->email = Input::get('email');
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        $user->phone = Input::get('phone');
        $user->organization = Input::get('organization');
        $user->save();
        return redirect($this->redirectTo)->withSuccess('Đăng ký tài khoản thành công. Vui lòng đăng nhập!');
    }
}
