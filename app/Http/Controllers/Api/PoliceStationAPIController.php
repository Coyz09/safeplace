<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PoliceStation;

class PoliceStationAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $police_station  = PoliceStation::all()->toArray();

        $response[ "data" ] = $police_station;

        $response[ "success" ] = 1 ;

        return response()->json($response);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'policestation_name' =>'required',
            'policestation_commander' =>'required',
            'policestation_location' =>'required',
            'policestation_schedule' =>'required',
            'policestation_contact' =>'required',
        ]);

        $police_station = PoliceStation::create($request->all());
        return response()->json($police_station, 200);
    }


}
