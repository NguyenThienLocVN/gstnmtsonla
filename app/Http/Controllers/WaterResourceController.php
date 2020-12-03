<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reports;
use App\Models\Licenses;
use App\Models\Cities;
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
        $districts = Cities::where('level', 1)->orderBy('name', 'ASC')->get();
        $communes = Cities::where('level', 2)->orderBy('name', 'ASC')->get();
        $constructions = Licenses::orderBy('construction_name', 'ASC')->get();
        return view('pages.tai-nguyen-nuoc.giam-sat.ho-thuy-dien-tren-2mw', ['districts' => $districts, 'communes' => $communes, 'constructions' => $constructions]);
    }

    public function getDataByDistrict($districtId){
        // Lay xa theo huyen
        $communes = Cities::where('parent_code', $districtId)->orderBy('name', 'ASC')->get();

        // Lay cong trinh theo huyen
        $constructions = Licenses::where('district_code', $districtId)->get();
        return response()->json(['constructions' => $constructions, 'communes' => $communes]);
    }

    // Lay cong trinh theo xa
    public function getConstructionsByCommune($communeId){
        $constructions = Licenses::where('commune_code', $communeId)->get();
        return response()->json(['constructions' => $constructions]);
    }

    // Quan ly cap phep nuoc mat
    public function surfaceWater(){
        $districts = Cities::where('level', 1)->orderBy('name', 'ASC')->get();
        $communes = Cities::where('level', 2)->orderBy('name', 'ASC')->get();
        $constructions = Licenses::orderBy('construction_name', 'ASC')->get();

        // Lay toa do dap thuy dien hien thi tren map
        $locationArray = ['type' => 'FeatureCollection',
                            'features' =>[]
                        ];

        foreach($constructions as $cons){
            array_push($locationArray['features'], 
                [
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [$cons->long_dams, $cons->lat_dams]
                    ],
                    'type' => 'Feature',
                    'properties' => [
                        'hoverContent' => "<b>$cons->title</b>",
                    ],
                    'id' => $cons->gid
                ]);
        }

        $locationJson = json_encode($locationArray, JSON_UNESCAPED_UNICODE);
        return view('pages.tai-nguyen-nuoc.cap-phep.nuoc-mat', ['districts' => $districts, 'communes' => $communes, 'constructions' => $constructions, 'locationJson' => $locationJson]);
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
