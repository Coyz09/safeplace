<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barangay;

class BarangayAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangay  = Barangay::all()->toArray();

        $response[ "data" ] = $barangay;

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
            'barangay_name' =>'required',
            'barangay_captain' =>'required',
            'barangay_location' =>'required',
            'barangay_schedule' =>'required',
            'barangay_contact' =>'required',
        ]);


        $barangay = Barangay::create($request->all());
        return response()->json($barangay, 200);
    }

}
