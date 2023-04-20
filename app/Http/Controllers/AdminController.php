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

use App\Models\PoliceStationReports;
use App\Models\Notification;


class AdminController extends Controller
{
    

    public function getBarangayArchives()
    {
        $barangay_reports = $users = DB::table('barangay_reports')
            ->select('*')
            ->where('year_reported',"2023")
            ->where('report_status',"Responded")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();

            // dd( $barangay_reports);

            return  Datatables::of($barangay_reports)
            ->addColumn('action', 'admin_archives.barangayaction')
            ->make();
    }

    public function barangayindex()
    {  $admin = DB::table('users')
        ->select('*',)
        ->where('id',(auth()->guard('web')->user()->id))
        ->first();

        return View::make('admin_archives.barangayindex',compact('admin'));
    }
    
    public function barangayedit($id)
    {
        $barangay_reports = BarangayReports::find($id);
        return View::make('admin_archives.barangay_report_details',compact('barangay_reports'));
    }


    public function getPoliceArchives()
    {
        $police_reports = $users = DB::table('police_station_reports')
            ->select('*')
            // ->where('year_reported',"2022")
            ->where('report_status',"Responded")
            ->orderBy('id', 'DESC')
            ->orderBy('year_reported', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();

// dd($police_reports);

            return  Datatables::of($police_reports)
            ->addColumn('action', 'admin_archives.policeaction')
            ->make();
    }

    public function policeindex()
    {  $admin = DB::table('users')
        ->select('*',)
        ->where('id',(auth()->guard('web')->user()->id))
        ->first();

        return View::make('admin_archives.policeindex',compact('admin'));
    }
    
    public function policeedit($id)
    {
        $police_reports = PoliceStationReports::find($id);
        return View::make('admin_archives.police_report_details',compact('police_reports'));
    }

      


}
