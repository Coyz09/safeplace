<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class Dashboard2Controller extends Controller
{
    public function getData()
    {
        $commoncrimetotalcentral = DB::table('barangay_reports')
           ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
           ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_centralbicutan")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


        $commoncrimeyearlycentral = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_centralbicutan")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlycentral = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_centralbicutan")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');



        $commoncrimetotalcentralsignal = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_centralsignalvillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlycentralsignal = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_centralsignalvillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlycentralsignal = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_centralsignalvillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');
                 
        $commoncrimetotalfortbonifacio = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_fortbonifacio")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


        $commoncrimeyearlyfortbonifacio = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_fortbonifacio")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlyfortbonifacio = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_fortbonifacio")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


        $commoncrimetotalkatuparan = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_katuparan")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlykatuparan = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_katuparan")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlykatuparan = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_katuparan")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


        $commoncrimetotalmaharlikavillage = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_maharlikavillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlymaharlikavillage = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_maharlikavillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlymaharlikavillage = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_maharlikavillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimetotalnorthdaanghari = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_northdaanghari")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlynorthdaanghari = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_northdaanghari")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlynorthdaanghari= DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_northdaanghari")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

   
        $commoncrimetotalnorthsignal = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_northsignalvillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlynorthsignal = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_northsignalvillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlynorthsignal= DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_northsignalvillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');



        $commoncrimetotalpinagsama = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_pinagsama")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlypinagsama = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_pinagsama")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlypinagsama = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_pinagsama")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


        $commoncrimetotalsouthdaanghari = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_southdaanghari")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlysouthdaanghari = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_southdaanghari")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlysouthdaanghari = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_southdaanghari")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');



        $commoncrimetotalsouthsignal = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_southsignalvillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlysouthsignal = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_southsignalvillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlysouthsignal = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_southsignalvillage")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');



        $commoncrimetotaltanyag = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_tanyag")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlytanyag = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_tanyag")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlytanyag = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_tanyag")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimetotalupper= DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_upperbicutan")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearlyupper = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_upperbicutan")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlyupper= DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_upperbicutan")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

     
        $commoncrimetotalwestern = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


        $commoncrimeyearlywestern = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearlywestern = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');



        return view('dashboard.admin_dashboard2', compact('commoncrimetotalcentral','commoncrimeyearlycentral','commoncrimetotalyearlycentral','commoncrimetotalcentralsignal','commoncrimeyearlycentralsignal','commoncrimetotalyearlycentralsignal','commoncrimetotalfortbonifacio','commoncrimeyearlyfortbonifacio','commoncrimetotalyearlyfortbonifacio','commoncrimetotalkatuparan','commoncrimeyearlykatuparan','commoncrimetotalyearlykatuparan','commoncrimetotalmaharlikavillage','commoncrimeyearlymaharlikavillage','commoncrimetotalyearlymaharlikavillage','commoncrimetotalnorthdaanghari','commoncrimeyearlynorthdaanghari','commoncrimetotalyearlynorthdaanghari','commoncrimetotalnorthsignal','commoncrimeyearlynorthsignal','commoncrimetotalyearlynorthsignal','commoncrimetotalpinagsama','commoncrimeyearlypinagsama','commoncrimetotalyearlypinagsama','commoncrimetotalsouthdaanghari','commoncrimeyearlysouthdaanghari','commoncrimetotalyearlysouthdaanghari','commoncrimetotalsouthsignal','commoncrimeyearlysouthsignal','commoncrimetotalyearlysouthsignal','commoncrimetotaltanyag','commoncrimeyearlytanyag','commoncrimetotalyearlytanyag','commoncrimetotalupper','commoncrimeyearlyupper','commoncrimetotalyearlyupper','commoncrimetotalwestern','commoncrimeyearlywestern','commoncrimetotalyearlywestern'));
    }

}
