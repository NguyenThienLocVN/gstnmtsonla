<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Offices;
use App\Roles;
use DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function quanLy()
    {
        $u = Users::all();
        $users = DB::table('users')->join("offices","offices.id","=","users.office_id")
        ->join("roles","roles.id","=","users.role_id")->get();

        return view('pages.tai-nguyen-nuoc.nguoi-dung.quan-ly-nguoi-dung',["users"=>$users]);
        
    }
}
