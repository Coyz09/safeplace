<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Barangay;
use App\Models\PoliceStation;
use App\Models\VerifiedUser;
use App\Models\UnverifiedUser;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function getCountandLocation()
    {
        $hospitals = Hospital::all();
        $mapHospitals = $hospitals->makeHidden([ 'created_at', 'updated_at']);
        $barangays = Barangay::all();
        $mapBarangays = $barangays->makeHidden(['created_at', 'updated_at']);
        $police = PoliceStation::all();
        $mapPolice = $police->makeHidden(['created_at', 'updated_at']);

        $unverifiedcount = UnverifiedUser::count();
        $verifiedcount = VerifiedUser::count();
        $barangaycount = Barangay::count();
        $hospitalcount = Hospital::count();
        $policecount = PoliceStation::count();

        $latitude = $hospitals->count() ? $hospitals->average('latitude') : 14.529602547244957 ;
        $longitude = $hospitals->count() ? $hospitals->average('longitude') : 121.06994858539447 ;
        // dd($latitude);

        
            $numberofbarangaypending= DB::table('barangay_reports')
            ->selectRaw('barangay, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->where('year_reported', '2023')
            ->where('report_status', 'Pending')
            ->groupBy('report_status', 'barangay')
            ->orderBy('total', 'desc')
            // ->get();
            ->pluck('barangay');

            
            $numberofbarangaypendingmonthly= DB::table('barangay_reports')
            ->selectRaw('barangay, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('year_reported', '2023')
            ->where('report_status', 'Pending')
            ->groupBy('report_status', 'barangay')
            ->orderBy('total', 'desc')
            // ->get();
            ->pluck('total');


            $numberofbarangaypendingyearly= DB::table('barangay_reports')
            ->selectRaw('barangay, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->where('year_reported', '2023')
            ->where('report_status', 'Pending')
            ->groupBy('report_status', 'barangay')
            ->orderBy('total', 'desc')
            // ->get();
            ->pluck('total');

            $numberofbarangayresponded= DB::table('barangay_reports')
            ->selectRaw('barangay, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->where('year_reported', '2023')
            ->where('report_status', 'Responded')
            ->groupBy('report_status', 'barangay')
            ->orderBy('total', 'desc')
            // ->get();
            ->pluck('barangay');

            
            $numberofbarangayrespondedmonthly= DB::table('barangay_reports')
            ->selectRaw('barangay, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('year_reported', '2023')
            ->where('report_status', 'Responded')
            ->groupBy('report_status', 'barangay')
            ->orderBy('total', 'desc')
            // ->get();
            ->pluck('total');


            $numberofbarangayrespondedyearly= DB::table('barangay_reports')
            ->selectRaw('barangay, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->where('year_reported', '2023')
            ->where('report_status', 'Responded')
            ->groupBy('report_status', 'barangay')
            ->orderBy('total', 'desc')
            // ->get();
            ->pluck('total');

            
         
            $numberofpolicepending= DB::table('police_station_reports')
            ->selectRaw('police_substation, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->where('year_reported', '2023')
            ->where('report_status', 'Pending')
            ->groupBy('report_status', 'police_substation')
            ->orderBy('total', 'desc')
            ->pluck('police_substation');
        // dd($numberofpolicepending);
        
            $numberofpolicependingmonthly= DB::table('police_station_reports')
            ->selectRaw('police_substation, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('year_reported', '2023')
            ->where('report_status', 'Pending')
            ->groupBy('report_status', 'police_substation')
            ->orderBy('total', 'desc')
            ->pluck('total');


            $numberofpolicependingyearly= DB::table('police_station_reports')
            ->selectRaw('police_substation, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->where('year_reported', '2023')
            ->where('report_status', 'Pending')
            ->groupBy('report_status', 'police_substation')
            ->orderBy('total', 'desc')
            ->pluck('total');

            $numberofpoliceresponded= DB::table('police_station_reports')
            ->selectRaw('police_substation, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->where('year_reported', '2023')
            ->where('report_status', 'Responded')
            ->groupBy('report_status', 'police_substation')
            ->orderBy('total', 'desc')
            ->pluck('police_substation');
         
            
            $numberofpolicerespondedmonthly= DB::table('police_station_reports')
            ->selectRaw('police_substation, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('year_reported', '2023')
            ->where('report_status', 'Responded')
            ->groupBy('report_status', 'police_substation')
            ->orderBy('total', 'desc')
            // ->get();
            ->pluck('total');
         

            $numberofpolicerespondedyearly= DB::table('police_station_reports')
            ->selectRaw('police_substation, report_status, COUNT(report_status) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->where('year_reported', '2023')
            ->where('report_status', 'Responded')
            ->groupBy('report_status', 'police_substation')
            ->orderBy('total', 'desc')
            // ->get();
            ->pluck('total');

 
            $policereport2023= DB::table('police_station_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'police_substation')
            ->where('year_reported', '2023')
            ->groupBy('police_substation')
            ->orderBy('total', 'desc')
            ->pluck('police_substation');
        //    dd( $policereport2023);

            $totalofpolicereportyearly2023= DB::table('police_station_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'police_substation')
            ->where('year_reported', '2023')
            ->groupBy('police_substation')
            ->orderBy('total', 'desc')
            ->pluck('total');

            $totalofpolicereportmonthly2023= DB::table('police_station_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'police_substation')
            ->where('year_reported', '2023')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->groupBy('police_substation')
            ->orderBy('total', 'desc')
            ->pluck('total');

            $barangayreport2023= DB::table('barangay_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'barangay')
            ->where('year_reported', '2023')
            ->groupBy('barangay')
            ->orderBy('total', 'desc')
            ->pluck('barangay');
// dd( $barangayreport2023);
            $totalofbarangayreportyearly2023= DB::table('barangay_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'barangay')
            ->where('year_reported', '2023')
            ->groupBy('barangay')
            ->orderBy('total', 'desc')
            ->pluck('total');

            $totalofbarangayreportmonthly2023= DB::table('barangay_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'barangay')
            ->where('year_reported', '2023')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->groupBy('barangay')
            ->orderBy('total', 'desc')
            ->pluck('total');
            // ->get();
            // dd($barangayreports);

            $allpolicereports= DB::table('police_station_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'police_substation')
            ->groupBy('police_substation')
            ->orderBy('police_substation', 'asc')
            ->pluck('police_substation');

            $totalpolicereports= DB::table('police_station_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'police_substation')
            ->groupBy('police_substation')
            ->orderBy('police_substation', 'asc')
            ->pluck('total');

            $policereports2023= DB::table('police_station_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'police_substation')
            ->where('year_reported', '2023')
            ->groupBy('police_substation')
            ->orderBy('police_substation', 'asc')
            ->pluck('total');

            $policereports2022= DB::table('police_station_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'police_substation')
            ->where('year_reported', '2022')
            ->groupBy('police_substation')
            ->orderBy('police_substation', 'asc')
            ->pluck('total');

            $policereports2021= DB::table('police_station_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'police_substation')
            ->where('year_reported', '2021')
            ->groupBy('police_substation')
            ->orderBy('police_substation', 'asc')
            ->pluck('total');

            $policereports2020= DB::table('police_station_reports')
            ->select( DB::raw('COUNT(report_status) as total'), 'police_substation')
            ->where('year_reported', '2020')
            ->groupBy('police_substation')
            ->orderBy('police_substation', 'asc')
            ->pluck('total');
            
            // dd( $allpolicereports,$policereports2023,$policereports2022,$policereports2021,$policereports2020);

        return view('dashboard.admin_dashboard', compact('police', 'mapPolice','barangays','mapBarangays','hospitals', 'mapHospitals', 'latitude', 'longitude','unverifiedcount','verifiedcount','barangaycount','hospitalcount','policecount','numberofbarangaypending','numberofbarangaypendingyearly','numberofbarangaypendingmonthly','numberofbarangayresponded','numberofbarangayrespondedmonthly','numberofbarangayrespondedyearly','numberofpolicepending','numberofpolicependingyearly','numberofpolicependingmonthly','numberofpoliceresponded','numberofpolicerespondedmonthly','numberofpolicerespondedyearly','policereport2023','totalofpolicereportmonthly2023','totalofpolicereportyearly2023','barangayreport2023','totalofbarangayreportmonthly2023','totalofbarangayreportyearly2023','allpolicereports','policereports2023','policereports2022','policereports2021','policereports2020','totalpolicereports'));
    }

    public function showHospital(Hospital $hospitals)
    {
        $hospitals->load([]);
        // $hospitals = Hospital::all()->first();
        // dd($hospital);
        return view('dashboard.hospital_info', compact('hospitals'));
    }

    public function showBarangay(Barangay $barangays)
    {
        $barangays->load([]);
    
        return view('dashboard.barangay_info', compact('barangays'));
    }

    public function showPolice(PoliceStation $polices)
    {
        $polices->load([]);
    
        return view('dashboard.policestation_info', compact('polices'));
    }
}
