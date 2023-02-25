<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\BarangayReports;
use App\Models\Barangay;
use App\Models\User;
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

        // $barangays = DB::table('barangays')
        //     ->join('barangay_accounts','barangays.id','=','barangay_accounts.barangay_id')
        //     ->join('users','users.id','=','barangay_accounts.user_id')
        //     ->select('*')
        //     ->where('barangay_accounts.role',"barangay_westernbicutan")
        //     ->get();

        // $barangay_reports =  $users = DB::table('barangay_reports')
        //     ->select('*')
        //     ->where('manage_by',"barangay_westernbicutan")
        //     ->get();
        // $barangay_reports = BarangayReports::select('*')->where('manage_by','barangay_westernbicutan')->get();
        // dd($barangay_reports);
        // $barangay_reports = BarangayReports::select('*');
        
        $users = DB::table('users')
            ->join('barangay_accounts','users.id','=','barangay_accounts.user_id')
            ->select('barangay_accounts.role')
            ->where('barangay_accounts.user_id',(auth()->guard('web')->user()->id))
            ->first();

        // dd($users);
        if (($users->role == "barangay_centralbicutan"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_centralbicutan")
            ->get();
        }
        elseif (($users->role == "barangay_centralsignalvillage"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_centralsignalvillage")
            ->get();
        
        }

        elseif (($users->role == "barangay_fortbonifacio"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_fortbonifacio")
            ->get();
          
        }
        elseif (($users->role == "barangay_katuparan"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_katuparan")
            ->get();
          
        }
        elseif (($users->role == "barangay_maharlikavillage"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_maharlikavillage")
            ->get();
           
        }
        elseif (($users->role == "barangay_northdaanghari"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_northdaanghari")
            ->get();
           
        }
        elseif (($users->role == "barangay_northsignalvillage"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_northsignalvillage")
            ->get();
          
        }
        elseif (($users->role == "barangay_pinagsama"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_pinagsama")
            ->get();
          
        }
        elseif (($users->role == "barangay_southdaanghari"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_southdaanghari")
            ->get();
         
        }
        elseif (($users->role == "barangay_southsignalvillage"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_southsignalvillage")
            ->get();
            
        }
        elseif (($users->role == "barangay_tanyag"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_tanyag")
            ->get();
            
        }
        elseif (($users->role == "barangay_upperbicutan"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_upperbicutan")
            ->get();
        }
        elseif (($users->role == "barangay_westernbicutan"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('manage_by',"barangay_westernbicutan")
            ->get();
            // dd($barangay_reports);
        }
       
       
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
