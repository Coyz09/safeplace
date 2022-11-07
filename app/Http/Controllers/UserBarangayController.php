<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\BarangayReports;
use Yajra\Datatables\Datatables;


class UserBarangayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('barangay_users.index');
    }

    public function getBarangayReports()
    {

        $barangay_reports = BarangayReports::select('*');
        return  Datatables::of($barangay_reports)
        ->addColumn('action', 'barangay_users.action')
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
        $barangay_reports = DB::table('barangay_reports')
        ->select('barangay_reports.*')
        ->get();

        $barangay_reports = BarangayReports::find($id);


        // dd($barangay_reports);
        return view('barangay_users.report_details',compact('barangay_reports'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barangay_reports = BarangayReports::find($id);
        return View::make('barangay_users.report_details',compact('barangay_reports'));
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

            $barangay_reports = BarangayReports::find($id);
            $barangay_reports ->update($request->all());
            return Redirect::to('/barangay_user')->with('success','Report updated!');

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
