<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reports;
use App\Models\Licenses;
use App\Models\Districts;
use DB;

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
        $districts = Districts::orderBy('district_name', 'ASC')->get();
        $constructions = Licenses::orderBy('construction_name', 'ASC')->get();
        return view('pages.tai-nguyen-nuoc.giam-sat.ho-thuy-dien-tren-2mw', ['districts' => $districts, 'constructions' => $constructions]);
    }

    public function getDataByDistrict($districtId){
        // Get constructions by district
        $constructions = Licenses::where('district_id', $districtId)->get();
        return response()->json(['constructions' => $constructions]);
    }

    // Quan ly cap phep nuoc mat
    public function surfaceWater(){
        $districts = Districts::orderBy('district_name', 'ASC')->get();
        $constructions = Licenses::orderBy('construction_name', 'ASC')->get();
        return view('pages.tai-nguyen-nuoc.cap-phep.nuoc-mat', ['districts' => $districts, 'constructions' => $constructions]);
    }

    // Lay thong tin ho chua theo ID
    public function getLicense($licenseId){
        $license = Licenses::where('license_num', $licenseId)->first();
        return response()->json($license);
    }

    // Lay thong tin bao cao
    public function getReports()
    {
        $rps = Reports::paginate(8);
        return view('pages.tai-nguyen-nuoc.bao-cao', ['reports' => $rps]);
    }
}
