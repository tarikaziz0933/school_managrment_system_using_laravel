<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PoliceStationSelect2Resource;
use App\Models\PoliceStation;
use Illuminate\Http\Request;

class PoliceStationController extends Controller
{

    public function select2(Request $request)
    {
        $policeStations = PoliceStation::query()
            ->when($request->filled('district_id'), function ($query) use ($request) {
                $query->where('district_id', $request->district_id);
            })
            ->get();

        return response()->json([
            'data' => PoliceStationSelect2Resource::collection($policeStations),
        ]);
    }


}
