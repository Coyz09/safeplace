<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;


class HospitalAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospital  = Hospital::all()->toArray();

        $response[ "data" ] = $hospital;

        $response[ "success" ] = 1 ;

        return response()->json($response);
    }


    public function store(Request $request)
    {
        $request->validate([
            'hospital_name' =>'required',
            'hospital_type' =>'required',
            'hospital_medical_director' =>'required',
            'hospital_location' =>'required',
            'hospital_schedule' =>'required',
            'hospital_contact' =>'required',
        ]);

        $hospital = Hospital::create($request->all());
        return response()->json($hospital, 200);
    }



}
