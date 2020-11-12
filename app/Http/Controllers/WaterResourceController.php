<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaterResource\Reports;

class WaterResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.tai-nguyen-nuoc.index');
    }

    public function hydropowerReservoirGreaterThan2MW()
    {
        return view('pages.tai-nguyen-nuoc.giam-sat.ho-thuy-dien-tren-2mw');
    }

    public function getReports()
    {
        $rps = Reports::paginate(8);
        return view('pages.tai-nguyen-nuoc.bao-cao', ['reports' => $rps]);
    }
}
