<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Charts\PoliceSubstationReport;
use App\Charts\PoliceMonthlyReport2020;
use App\Charts\PoliceMonthlyReport2021;
use App\Charts\PoliceMonthlyReport2022;
use App\Charts\PoliceMonthlyReport2023;
use Carbon\Carbon;
use DatePeriod;
use App\Models\User;

class PoliceSubstationDashboardController extends Controller
{
    public function __construct(){
        $this->bgcolor = collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]);
    }

    public function index(){

        $users = DB::table('users')
        ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
        ->select('police_station_accounts.role')
        ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
        ->first();


    if (($users->role == "police_substation1"))
        {
         
            $totaldailyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('police_substation',"police_substation1")->count();
 
            $totalmonthlyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('police_substation',"police_substation1")->count();


            $totalweeklyreports= DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('police_substation',"police_substation1")
               ->count();

            $totalreports = DB::table('police_station_reports')->select('*')->where('police_substation',"police_substation1")->count();

            // dd($totalmonthlyreports);

            $months  =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation1")
                ->where('year_reported', '2020')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck('month');

            // $policereports2020 =  DB::table('police_station_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('police_substation',"police_substation1")
            // ->where('year_reported', '2020')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck(DB::raw('count(month) AS total'));

            $allpolicereports = DB::table('police_station_reports')->select('id', 'date_reported')
            ->where('police_substation',"police_substation1")
             ->orderBy('date_reported','asc')
             ->get()
 
             ->groupBy(function($date) {
             return Carbon::parse($date->date_reported)->format('m'); // grouping by months
             });
 
 
                 $allnumberreports= [];
                 $totaloverallreports = [];
 
                 foreach ($allpolicereports as $key => $value) {
                     $allnumberreports[(int)$key] = count($value);
                 }
 
                 for($i = 0; $i <= 12; $i++){
                     if(!empty($allnumberreports[$i])){
                         $totaloverallreports[$i] = $allnumberreports[$i];    
                     }else{
                         $totaloverallreports[$i] = 0;    
                     }
                 }

                //  dd( $allpolicereports,$totaloverallreports);

            $policereports2020 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation1")
            ->where('year_reported', '2020')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2020= [];
                $totalallreports2020 = [];

                foreach ($policereports2020 as $key => $value) {
                    $numberreports2020[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2020[$i])){
                        $totalallreports2020[$i] = $numberreports2020[$i];    
                    }else{
                        $totalallreports2020[$i] = 0;    
                    }
                }

            // $policereports2021 =  DB::table('police_station_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('police_substation',"police_substation1")
            // ->where('year_reported', '2021')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck(DB::raw('count(month) AS total'));
     

            $policereports2021 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation1")
            ->where('year_reported', '2021')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2021= [];
                $totalallreports2021 = [];

                foreach ($policereports2021 as $key => $value) {
                    $numberreports2021[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2021[$i])){
                        $totalallreports2021[$i] = $numberreports2021[$i];    
                    }else{
                        $totalallreports2021[$i] = 0;    
                    }
                }


        //   $policereports2022 =  DB::table('police_station_reports')
        //     ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
        //     ->where('police_substation',"police_substation1")
        //     ->where('year_reported', '2022')
        //     ->orderBy('date_reported')
        //     ->groupBy('month')
        //     ->pluck(DB::raw('count(month) AS total'));

            $policereports2022 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation1")
            ->where('year_reported', '2022')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2022= [];
                $totalallreports2022 = [];

                foreach ($policereports2022 as $key => $value) {
                    $numberreports2022[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2022[$i])){
                        $totalallreports2022[$i] = $numberreports2022[$i];    
                    }else{
                        $totalallreports2022[$i] = 0;    
                    }
                }
            // ->all();
   

        //    $policereports2023 =  DB::table('police_station_reports')
        //    ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
        //    ->where('police_substation',"police_substation1")
        //    ->where('year_reported', '2023')
        //    ->orderBy('date_reported')
        //    ->groupBy('month')
        //    ->pluck(DB::raw('count(month) AS total'));

           $policereports2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation1")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2023= [];
                $totalallreports2023 = [];

                foreach ($policereports2023 as $key => $value) {
                    $numberreports2023[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2023[$i])){
                        $totalallreports2023[$i] = $numberreports2023[$i];    
                    }else{
                        $totalallreports2023[$i] = 0;    
                    }
                }

            //    dd( $policereports2023);


           $policereportss2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation1")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($policereportss2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

             $policereportsresponded = DB::table('police_station_reports')->select('id', 'date_reported')
             ->where('police_substation',"police_substation1")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($policereportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                    $policereportspending = DB::table('police_station_reports')->select('id', 'date_reported')
                    ->where('police_substation',"police_substation1")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($policereportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $policereportstransferred = DB::table('police_station_reports')->select('id', 'date_reported')
                  ->where('police_substation',"police_substation1")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($policereportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }
      


            $commoncrimetotal2023 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2021') 
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2021')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            // dd($commoncrimeyearly2020);



        //    ->all();

        // dd($policereports2020);
        }


    elseif (($users->role == "police_substation2"))
        {
     
            $totaldailyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('police_substation',"police_substation2")->count();
 
            $totalmonthlyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('police_substation',"police_substation2")->count();


            $totalweeklyreports= DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('police_substation',"police_substation2")
               ->count();

            $totalreports = DB::table('police_station_reports')->select('*')->where('police_substation',"police_substation2")->count();

            // dd($totalmonthlyreports);

            $months  =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation2")
                ->where('year_reported', '2020')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck('month');

            // $policereports2020 =  DB::table('police_station_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('police_substation',"police_substation1")
            // ->where('year_reported', '2020')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck(DB::raw('count(month) AS total'));

            $allpolicereports = DB::table('police_station_reports')->select('id', 'date_reported')
            ->where('police_substation',"police_substation2")
             ->orderBy('date_reported','asc')
             ->get()
 
             ->groupBy(function($date) {
             return Carbon::parse($date->date_reported)->format('m'); // grouping by months
             });
 
 
                 $allnumberreports= [];
                 $totaloverallreports = [];
 
                 foreach ($allpolicereports as $key => $value) {
                     $allnumberreports[(int)$key] = count($value);
                 }
 
                 for($i = 0; $i <= 12; $i++){
                     if(!empty($allnumberreports[$i])){
                         $totaloverallreports[$i] = $allnumberreports[$i];    
                     }else{
                         $totaloverallreports[$i] = 0;    
                     }
                 }

                //  dd( $allpolicereports,$totaloverallreports);

            $policereports2020 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation2")
            ->where('year_reported', '2020')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2020= [];
                $totalallreports2020 = [];

                foreach ($policereports2020 as $key => $value) {
                    $numberreports2020[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2020[$i])){
                        $totalallreports2020[$i] = $numberreports2020[$i];    
                    }else{
                        $totalallreports2020[$i] = 0;    
                    }
                }

            // $policereports2021 =  DB::table('police_station_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('police_substation',"police_substation1")
            // ->where('year_reported', '2021')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck(DB::raw('count(month) AS total'));
     

            $policereports2021 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation2")
            ->where('year_reported', '2021')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2021= [];
                $totalallreports2021 = [];

                foreach ($policereports2021 as $key => $value) {
                    $numberreports2021[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2021[$i])){
                        $totalallreports2021[$i] = $numberreports2021[$i];    
                    }else{
                        $totalallreports2021[$i] = 0;    
                    }
                }


        //   $policereports2022 =  DB::table('police_station_reports')
        //     ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
        //     ->where('police_substation',"police_substation1")
        //     ->where('year_reported', '2022')
        //     ->orderBy('date_reported')
        //     ->groupBy('month')
        //     ->pluck(DB::raw('count(month) AS total'));

            $policereports2022 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation2")
            ->where('year_reported', '2022')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2022= [];
                $totalallreports2022 = [];

                foreach ($policereports2022 as $key => $value) {
                    $numberreports2022[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2022[$i])){
                        $totalallreports2022[$i] = $numberreports2022[$i];    
                    }else{
                        $totalallreports2022[$i] = 0;    
                    }
                }
            // ->all();
   

        //    $policereports2023 =  DB::table('police_station_reports')
        //    ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
        //    ->where('police_substation',"police_substation1")
        //    ->where('year_reported', '2023')
        //    ->orderBy('date_reported')
        //    ->groupBy('month')
        //    ->pluck(DB::raw('count(month) AS total'));

           $policereports2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation2")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2023= [];
                $totalallreports2023 = [];

                foreach ($policereports2023 as $key => $value) {
                    $numberreports2023[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2023[$i])){
                        $totalallreports2023[$i] = $numberreports2023[$i];    
                    }else{
                        $totalallreports2023[$i] = 0;    
                    }
                }

            //    dd( $policereports2023);


           $policereportss2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation2")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($policereportss2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

             $policereportsresponded = DB::table('police_station_reports')->select('id', 'date_reported')
             ->where('police_substation',"police_substation2")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($policereportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                    $policereportspending = DB::table('police_station_reports')->select('id', 'date_reported')
                    ->where('police_substation',"police_substation2")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($policereportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $policereportstransferred = DB::table('police_station_reports')->select('id', 'date_reported')
                  ->where('police_substation',"police_substation2")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($policereportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }
      


            $commoncrimetotal2023 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation2")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation2")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation2")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation2")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation2")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation2")
            ->where('year_reported', '2021') 
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation2")
            ->where('year_reported', '2021')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation2")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation2")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

        }
                
                
        
    elseif (($users->role == "police_substation3"))
        {
            $totaldailyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('police_substation',"police_substation3")->count();
 
            $totalmonthlyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('police_substation',"police_substation3")->count();


            $totalweeklyreports= DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('police_substation',"police_substation3")
               ->count();

            $totalreports = DB::table('police_station_reports')->select('*')->where('police_substation',"police_substation3")->count();

            $months  =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation3")
                ->where('year_reported', '2020')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck('month');

            $allpolicereports = DB::table('police_station_reports')->select('id', 'date_reported')
            ->where('police_substation',"police_substation3")
             ->orderBy('date_reported','asc')
             ->get()
 
             ->groupBy(function($date) {
             return Carbon::parse($date->date_reported)->format('m'); // grouping by months
             });
 
 
                 $allnumberreports= [];
                 $totaloverallreports = [];
 
                 foreach ($allpolicereports as $key => $value) {
                     $allnumberreports[(int)$key] = count($value);
                 }
 
                 for($i = 0; $i <= 12; $i++){
                     if(!empty($allnumberreports[$i])){
                         $totaloverallreports[$i] = $allnumberreports[$i];    
                     }else{
                         $totaloverallreports[$i] = 0;    
                     }
                 }

        
            $policereports2020 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation3")
            ->where('year_reported', '2020')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2020= [];
                $totalallreports2020 = [];

                foreach ($policereports2020 as $key => $value) {
                    $numberreports2020[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2020[$i])){
                        $totalallreports2020[$i] = $numberreports2020[$i];    
                    }else{
                        $totalallreports2020[$i] = 0;    
                    }
                }

            $policereports2021 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation3")
            ->where('year_reported', '2021')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2021= [];
                $totalallreports2021 = [];

                foreach ($policereports2021 as $key => $value) {
                    $numberreports2021[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2021[$i])){
                        $totalallreports2021[$i] = $numberreports2021[$i];    
                    }else{
                        $totalallreports2021[$i] = 0;    
                    }
                }

            $policereports2022 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation3")
            ->where('year_reported', '2022')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2022= [];
                $totalallreports2022 = [];

                foreach ($policereports2022 as $key => $value) {
                    $numberreports2022[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2022[$i])){
                        $totalallreports2022[$i] = $numberreports2022[$i];    
                    }else{
                        $totalallreports2022[$i] = 0;    
                    }
                }
           $policereports2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation3")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2023= [];
                $totalallreports2023 = [];

                foreach ($policereports2023 as $key => $value) {
                    $numberreports2023[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2023[$i])){
                        $totalallreports2023[$i] = $numberreports2023[$i];    
                    }else{
                        $totalallreports2023[$i] = 0;    
                    }
                }

            //    dd( $policereports2023);


           $policereportss2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation3")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($policereportss2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

             $policereportsresponded = DB::table('police_station_reports')->select('id', 'date_reported')
             ->where('police_substation',"police_substation3")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($policereportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                    $policereportspending = DB::table('police_station_reports')->select('id', 'date_reported')
                    ->where('police_substation',"police_substation3")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($policereportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $policereportstransferred = DB::table('police_station_reports')->select('id', 'date_reported')
                  ->where('police_substation',"police_substation3")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($policereportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }
      


            $commoncrimetotal2023 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2021') 
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2021')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            }            
   
    elseif (($users->role == "police_substation6"))
        {
                
            $totaldailyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('police_substation',"police_substation6")->count();
 
            $totalmonthlyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('police_substation',"police_substation6")->count();


            $totalweeklyreports= DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('police_substation',"police_substation6")
               ->count();

            $totalreports = DB::table('police_station_reports')->select('*')->where('police_substation',"police_substation6")->count();

            // dd($totalmonthlyreports);

            $months  =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation6")
                ->where('year_reported', '2020')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck('month');
    
            $allpolicereports = DB::table('police_station_reports')->select('id', 'date_reported')
            ->where('police_substation',"police_substation6")
             ->orderBy('date_reported','asc')
             ->get()
 
             ->groupBy(function($date) {
             return Carbon::parse($date->date_reported)->format('m'); // grouping by months
             });
 
 
                 $allnumberreports= [];
                 $totaloverallreports = [];
 
                 foreach ($allpolicereports as $key => $value) {
                     $allnumberreports[(int)$key] = count($value);
                 }
 
                 for($i = 0; $i <= 12; $i++){
                     if(!empty($allnumberreports[$i])){
                         $totaloverallreports[$i] = $allnumberreports[$i];    
                     }else{
                         $totaloverallreports[$i] = 0;    
                     }
                 }

            $policereports2020 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation6")
            ->where('year_reported', '2020')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2020= [];
                $totalallreports2020 = [];

                foreach ($policereports2020 as $key => $value) {
                    $numberreports2020[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2020[$i])){
                        $totalallreports2020[$i] = $numberreports2020[$i];    
                    }else{
                        $totalallreports2020[$i] = 0;    
                    }
                }

            $policereports2021 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation6")
            ->where('year_reported', '2021')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2021= [];
                $totalallreports2021 = [];

                foreach ($policereports2021 as $key => $value) {
                    $numberreports2021[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2021[$i])){
                        $totalallreports2021[$i] = $numberreports2021[$i];    
                    }else{
                        $totalallreports2021[$i] = 0;    
                    }
                }

            $policereports2022 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation6")
            ->where('year_reported', '2022')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2022= [];
                $totalallreports2022 = [];

                foreach ($policereports2022 as $key => $value) {
                    $numberreports2022[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2022[$i])){
                        $totalallreports2022[$i] = $numberreports2022[$i];    
                    }else{
                        $totalallreports2022[$i] = 0;    
                    }
                }
         
           $policereports2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation6")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2023= [];
                $totalallreports2023 = [];

                foreach ($policereports2023 as $key => $value) {
                    $numberreports2023[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2023[$i])){
                        $totalallreports2023[$i] = $numberreports2023[$i];    
                    }else{
                        $totalallreports2023[$i] = 0;    
                    }
                }

            //    dd( $policereports2023);


           $policereportss2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation6")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($policereportss2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

             $policereportsresponded = DB::table('police_station_reports')->select('id', 'date_reported')
             ->where('police_substation',"police_substation6")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($policereportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                    $policereportspending = DB::table('police_station_reports')->select('id', 'date_reported')
                    ->where('police_substation',"police_substation6")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($policereportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $policereportstransferred = DB::table('police_station_reports')->select('id', 'date_reported')
                  ->where('police_substation',"police_substation6")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($policereportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }
      


            $commoncrimetotal2023 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2021') 
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2021')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');
    
                }            
    elseif (($users->role == "police_substation7"))
        {
             
            $totaldailyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('police_substation',"police_substation7")->count();
 
            $totalmonthlyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('police_substation',"police_substation7")->count();


            $totalweeklyreports= DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('police_substation',"police_substation7")
               ->count();

            $totalreports = DB::table('police_station_reports')->select('*')->where('police_substation',"police_substation7")->count();

            // dd($totalmonthlyreports);

            $months  =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation7")
                ->where('year_reported', '2020')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck('month');

        
            $allpolicereports = DB::table('police_station_reports')->select('id', 'date_reported')
            ->where('police_substation',"police_substation7")
             ->orderBy('date_reported','asc')
             ->get()
 
             ->groupBy(function($date) {
             return Carbon::parse($date->date_reported)->format('m'); // grouping by months
             });
 
 
                 $allnumberreports= [];
                 $totaloverallreports = [];
 
                 foreach ($allpolicereports as $key => $value) {
                     $allnumberreports[(int)$key] = count($value);
                 }
 
                 for($i = 0; $i <= 12; $i++){
                     if(!empty($allnumberreports[$i])){
                         $totaloverallreports[$i] = $allnumberreports[$i];    
                     }else{
                         $totaloverallreports[$i] = 0;    
                     }
                 }

            $policereports2020 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation7")
            ->where('year_reported', '2020')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2020= [];
                $totalallreports2020 = [];

                foreach ($policereports2020 as $key => $value) {
                    $numberreports2020[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2020[$i])){
                        $totalallreports2020[$i] = $numberreports2020[$i];    
                    }else{
                        $totalallreports2020[$i] = 0;    
                    }
                }

            $policereports2021 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation7")
            ->where('year_reported', '2021')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2021= [];
                $totalallreports2021 = [];

                foreach ($policereports2021 as $key => $value) {
                    $numberreports2021[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2021[$i])){
                        $totalallreports2021[$i] = $numberreports2021[$i];    
                    }else{
                        $totalallreports2021[$i] = 0;    
                    }
                }

            $policereports2022 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation7")
            ->where('year_reported', '2022')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2022= [];
                $totalallreports2022 = [];

                foreach ($policereports2022 as $key => $value) {
                    $numberreports2022[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2022[$i])){
                        $totalallreports2022[$i] = $numberreports2022[$i];    
                    }else{
                        $totalallreports2022[$i] = 0;    
                    }
                }
           
           $policereports2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation7")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2023= [];
                $totalallreports2023 = [];

                foreach ($policereports2023 as $key => $value) {
                    $numberreports2023[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2023[$i])){
                        $totalallreports2023[$i] = $numberreports2023[$i];    
                    }else{
                        $totalallreports2023[$i] = 0;    
                    }
                }

            //    dd( $policereports2023);


           $policereportss2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation7")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($policereportss2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

             $policereportsresponded = DB::table('police_station_reports')->select('id', 'date_reported')
             ->where('police_substation',"police_substation7")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($policereportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                    $policereportspending = DB::table('police_station_reports')->select('id', 'date_reported')
                    ->where('police_substation',"police_substation7")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($policereportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $policereportstransferred = DB::table('police_station_reports')->select('id', 'date_reported')
                  ->where('police_substation',"police_substation7")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($policereportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }
      


            $commoncrimetotal2023 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation7")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation7")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation7")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation7")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation7")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation7")
            ->where('year_reported', '2021') 
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation7")
            ->where('year_reported', '2021')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation7")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation7")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');
        
        }            


    elseif (($users->role == "police_substation8"))
        {
             
            $totaldailyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('police_substation',"police_substation8")->count();
 
            $totalmonthlyreports = DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('police_substation',"police_substation8")->count();


            $totalweeklyreports= DB::table('police_station_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('police_substation',"police_substation8")
               ->count();

            $totalreports = DB::table('police_station_reports')->select('*')->where('police_substation',"police_substation8")->count();

            // dd($totalmonthlyreports);

            $months  =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation8")
                ->where('year_reported', '2020')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck('month');

            $allpolicereports = DB::table('police_station_reports')->select('id', 'date_reported')
            ->where('police_substation',"police_substation8")
             ->orderBy('date_reported','asc')
             ->get()
 
             ->groupBy(function($date) {
             return Carbon::parse($date->date_reported)->format('m'); // grouping by months
             });
 
 
                 $allnumberreports= [];
                 $totaloverallreports = [];
 
                 foreach ($allpolicereports as $key => $value) {
                     $allnumberreports[(int)$key] = count($value);
                 }
 
                 for($i = 0; $i <= 12; $i++){
                     if(!empty($allnumberreports[$i])){
                         $totaloverallreports[$i] = $allnumberreports[$i];    
                     }else{
                         $totaloverallreports[$i] = 0;    
                     }
                 }

            $policereports2020 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation8")
            ->where('year_reported', '2020')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2020= [];
                $totalallreports2020 = [];

                foreach ($policereports2020 as $key => $value) {
                    $numberreports2020[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2020[$i])){
                        $totalallreports2020[$i] = $numberreports2020[$i];    
                    }else{
                        $totalallreports2020[$i] = 0;    
                    }
                }

            $policereports2021 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation8")
            ->where('year_reported', '2021')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2021= [];
                $totalallreports2021 = [];

                foreach ($policereports2021 as $key => $value) {
                    $numberreports2021[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2021[$i])){
                        $totalallreports2021[$i] = $numberreports2021[$i];    
                    }else{
                        $totalallreports2021[$i] = 0;    
                    }
                }

            $policereports2022 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation8")
            ->where('year_reported', '2022')
            ->orderBy('date_reported')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });

                $numberreports2022= [];
                $totalallreports2022 = [];

                foreach ($policereports2022 as $key => $value) {
                    $numberreports2022[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2022[$i])){
                        $totalallreports2022[$i] = $numberreports2022[$i];    
                    }else{
                        $totalallreports2022[$i] = 0;    
                    }
                }
           
           $policereports2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation8")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports2023= [];
                $totalallreports2023 = [];

                foreach ($policereports2023 as $key => $value) {
                    $numberreports2023[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports2023[$i])){
                        $totalallreports2023[$i] = $numberreports2023[$i];    
                    }else{
                        $totalallreports2023[$i] = 0;    
                    }
                }

            //    dd( $policereports2023);


           $policereportss2023 = DB::table('police_station_reports')->select('id', 'date_reported')
           ->where('police_substation',"police_substation8")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($policereportss2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

             $policereportsresponded = DB::table('police_station_reports')->select('id', 'date_reported')
             ->where('police_substation',"police_substation8")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($policereportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                    $policereportspending = DB::table('police_station_reports')->select('id', 'date_reported')
                    ->where('police_substation',"police_substation8")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($policereportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $policereportstransferred = DB::table('police_station_reports')->select('id', 'date_reported')
                  ->where('police_substation',"police_substation8")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($policereportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }
      


            $commoncrimetotal2023 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation8")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation8")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2023 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('police_substation',"police_substation8")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation8")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2022 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation8")
            ->where('year_reported', '2022')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation8")
            ->where('year_reported', '2021') 
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2021 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation8")
            ->where('year_reported', '2021')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            $commoncrimeyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation8")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly2020 = DB::table('police_station_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->where('police_substation',"police_substation8")
            ->where('year_reported', '2020')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');
        }            
                 
    

    
    return view('dashboard.policestation_dashboard',compact('totaloverallreports','totalallreports2023','totalallreports2022','totalallreports2021','totalallreports2020','totaldailyreports','totalmonthlyreports','totalweeklyreports','totalreports','months','policereports2020','policereports2021','policereports2022','policereports2023','policereportss2023','totalresponded','totalpending','totaltransferred','totalallreports','commoncrimetotal2023','commoncrimeyearly2023','commoncrimetotalyearly2023','commoncrimeyearly2022','commoncrimetotalyearly2022','commoncrimeyearly2021','commoncrimetotalyearly2021','commoncrimeyearly2020','commoncrimetotalyearly2020'));


}
}
