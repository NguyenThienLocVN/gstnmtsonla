<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaterResource\Constructions;
use App\Models\WaterResource\Districts;
use App\Models\WaterResource\Subregions;
use App\Models\WaterResource\Licenses;

class LicensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function surfaceWater(){
        $districts = Districts::orderBy('district_name', 'ASC')->get();
        $subregions = Subregions::orderBy('subregion_name', 'ASC')->get();
        $constructions = Constructions::orderBy('construction_name', 'ASC')->get();
        return view('pages.tai-nguyen-nuoc.cap-phep.nuoc-mat', ['districts' => $districts, 'subregions' => $subregions, 'constructions' => $constructions]);
    }

    public function getLicense($licenseId){
        $license = Licenses::where('license_num', $licenseId)->first();
        return response()->json($license);
    }
}
