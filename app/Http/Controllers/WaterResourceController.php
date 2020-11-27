<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaterResource\Reports;
use App\Models\WaterResource\Constructions;
use App\Models\WaterResource\Districts;
use App\Models\WaterResource\Subregions;
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
        $subregions = Subregions::orderBy('subregion_name', 'ASC')->get();
        $constructions = Constructions::orderBy('construction_name', 'ASC')->get();
        return view('pages.tai-nguyen-nuoc.giam-sat.ho-thuy-dien-tren-2mw', ['districts' => $districts, 'subregions' => $subregions, 'constructions' => $constructions]);
    }

    
    public function getDataByDistrict($districtId){
        // Get constructions by district
        $constructions = Constructions::where('district_id', $districtId)->get();

        // Get subregion by district
        $subregions = DB::table('constructions')->where('district_id', $districtId)
                    ->join('subregions', 'constructions.subregion_id', '=', 'subregions.id')
                    ->select('constructions.*','subregions.*', 'constructions.id as userID' )
                    ->get();

        return response()->json(['constructions' => $constructions, 'subregions' => $subregions]);
    }

    // Get constructions by subregion
    public function getConstructionsBySubregion($subregionId){
        $constructions = Constructions::where('subregion_id', $subregionId)->get();
        return response()->json($constructions);
    }

    public function getReports()
    {
        $rps = Reports::paginate(8);
        return view('pages.tai-nguyen-nuoc.bao-cao', ['reports' => $rps]);
    }
}
