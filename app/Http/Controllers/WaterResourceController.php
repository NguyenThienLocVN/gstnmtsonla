<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaterResource\Reports;
use App\Models\WaterResource\Constructions;
use App\Models\WaterResource\Districts;
use App\Models\WaterResource\Subregions;

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
        $subregions = Subregions::all();
        $constructions = Constructions::all();
        return view('pages.tai-nguyen-nuoc.giam-sat.ho-thuy-dien-tren-2mw', ['districts' => $districts, 'subregions' => $subregions, 'constructions' => $constructions]);
    }

    // Get constructions by district
    public function getConstructionsByDistrict($districtId){
        $constructions = Constructions::where('district_id', $districtId)->get();
        return response()->json($constructions);
    }

    public function getReports()
    {
        $rps = Reports::paginate(8);
        return view('pages.tai-nguyen-nuoc.bao-cao', ['reports' => $rps]);
    }
}
