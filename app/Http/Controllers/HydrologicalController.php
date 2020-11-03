<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HydrologicalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.khi-tuong-thuy-van');
    }

    public function meteorologyData()
    {
        return view('pages.khi-tuong-thuy-van.so-lieu-khi-tuong');
    }
}
