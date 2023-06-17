<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class Dashboard3Controller extends Controller
{


    public function getData(){

        $commoncrimetotal1 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation1")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearly1 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation1")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearly1 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation1")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


     
        $commoncrimetotal2 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation2")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearly2= DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation2")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearly2 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation2")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


        $commoncrimetotal3 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation3")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearly3 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation3")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearly3 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation3")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


        $commoncrimetotal6= DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation6")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearly6 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation6")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearly6 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation6")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');      

        $commoncrimetotal7 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation7")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearly7 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation7")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearly7 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation7")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');


        $commoncrimetotal8= DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation8")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        $commoncrimeyearly8 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation8")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

        $commoncrimetotalyearly8 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation8")
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

    
    return view('dashboard.admin_dashboard3',compact('commoncrimetotal1','commoncrimeyearly1','commoncrimetotalyearly1','commoncrimetotal2','commoncrimeyearly2','commoncrimetotalyearly2','commoncrimetotal3','commoncrimeyearly3','commoncrimetotalyearly3','commoncrimetotal6','commoncrimeyearly6','commoncrimetotalyearly6','commoncrimetotal7','commoncrimeyearly7','commoncrimetotalyearly7','commoncrimetotal8','commoncrimeyearly8','commoncrimetotalyearly8'));


}
}
