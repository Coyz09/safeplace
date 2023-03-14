<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\PoliceStationReports;
use Yajra\Datatables\Datatables;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Police_Substation_ReportsImport;


class UserPoliceStationController extends Controller
{


     public function import(Request $request){
        $request->validate([
            'excel_file'=> 'required|mimes:xlsx'
        ]);
        
        Excel::import(new Police_Substation_ReportsImport, $request->file('excel_file'));
        return View::make('policestation_users.index');

     }

    public function index()
    {
        return View::make('policestation_users.index');
    }


    public function getPoliceStationReports()
    {
        $police_reports = PoliceStationReports::select('*');
        return  Datatables::of($police_reports)
        ->addColumn('action', 'policestation_users.action')
        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $police_reports = DB::table('police_station_reports')
        ->select('police_station_reports.*')
        ->get();

        $police_reports = PoliceStationReports::find($id);


        // dd($police_reports);
        return view('policestation_users.report_details',compact('police_reports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $police_reports = PoliceStationReports::find($id);
        return View::make('policestation_users.report_details',compact('police_reports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $police_reports = PoliceStationReports::find($id);
        $police_reports ->update($request->all());
        return Redirect::to('/policestation_user')->with('success','Police Station Reports Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
