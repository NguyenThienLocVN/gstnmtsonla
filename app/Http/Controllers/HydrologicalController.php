<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MeteorologyData;

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

    public function getMeteorologyData(){
        $meteorologyData = MeteorologyData::where('Station_ID', 3)->get();
        return ['meteorologyData' => $meteorologyData];
    }
}
