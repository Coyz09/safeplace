<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Carbon\Carbon;
use DatePeriod;

class BarangayDashboardController extends Controller
{
    public function index(){

        $users = DB::table('users')
        ->join('barangay_accounts','users.id','=','barangay_accounts.user_id')
        ->select('barangay_accounts.role')
        ->where('barangay_accounts.user_id',(auth()->guard('web')->user()->id))
        ->first();
 
       if (($users->role == "barangay_centralbicutan"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_centralbicutan")->count();
                              
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_centralbicutan")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_centralbicutan")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_centralbicutan")->count();
         
            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_centralbicutan")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_centralbicutan")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_centralbicutan")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_centralbicutan")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_centralbicutan")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_centralbicutan")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_centralbicutan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_centralbicutan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_centralbicutan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_centralbicutan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');

        }
        elseif (($users->role == "barangay_centralsignalvillage"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_centralsignalvillage")->count();
                           
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_centralsignalvillage")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_centralsignalvillage")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_centralsignalvillage")->count();

         
            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_centralsignalvillage")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_centralsignalvillage")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_centralsignalvillage")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_centralsignalvillage")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_centralsignalvillage")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_centralsignalvillage")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                     $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_centralsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_centralsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_centralsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_centralsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
        
        }
        elseif (($users->role == "barangay_fortbonifacio"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_fortbonifacio")->count();
                        
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_fortbonifacio")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_fortbonifacio")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_fortbonifacio")->count();


            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_fortbonifacio")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_fortbonifacio")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');
            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_fortbonifacio")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_fortbonifacio")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_fortbonifacio")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_fortbonifacio")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_fortbonifacio")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_fortbonifacio")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_fortbonifacio")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_fortbonifacio")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
           
          
        }
        elseif (($users->role == "barangay_katuparan"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_katuparan")->count();
                     
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_katuparan")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_katuparan")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_katuparan")->count();



            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_katuparan")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_katuparan")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');
          
            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_katuparan")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_katuparan")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_katuparan")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_katuparan")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }
                           
                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_katuparan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_katuparan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_katuparan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_katuparan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
           
        }
        elseif (($users->role == "barangay_maharlikavillage"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_maharlikavillage")->count();
                     
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_maharlikavillage")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_maharlikavillage")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_maharlikavillage")->count();


            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_maharlikavillage")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_maharlikavillage")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_maharlikavillage")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_maharlikavillage")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_maharlikavillage")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_maharlikavillage")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                        
                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_maharlikavillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_maharlikavillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_maharlikavillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_maharlikavillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
           
        }
        elseif (($users->role == "barangay_northdaanghari"))
        {
            $totaldailyreports = DB::table('barangay_reports'->whereYear('date_reported', Carbon::now()->year))->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_northdaanghari")->count();
                  
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_northdaanghari")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_northdaanghari")
               ->count();

             $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_northdaanghari")->count();


            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_northdaanghari")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_northdaanghari")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            
            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_northdaanghari")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_northdaanghari")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_barangay_northdaangharitanyag")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_northdaanghari")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_northdaanghari")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_northdaanghari")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_northdaanghari")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_northdaanghari")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
           
        }
        elseif (($users->role == "barangay_northsignalvillage"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_northsignalvillage")->count();
               
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_northsignalvillage")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_northsignalvillage")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_northsignalvillage")->count();


            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_northsignalvillage")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_northsignalvillage")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            
            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_northsignalvillage")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_northsignalvillage")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_northsignalvillage")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_northsignalvillage")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_northsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_northsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_northsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_northsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
          
        }
        elseif (($users->role == "barangay_pinagsama"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_pinagsama")->count();
            
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_pinagsama")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_pinagsama")
               ->count();
            
            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_pinagsama")->count();

            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_pinagsama")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_pinagsama")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            
            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_pinagsama")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_pinagsama")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_pinagsama")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_pinagsama")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_pinagsama")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_pinagsama")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_pinagsama")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_pinagsama")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
         
          
        }
        elseif (($users->role == "barangay_southdaanghari"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_southdaanghari")->count();
         
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_southdaanghari")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_southdaanghari")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_southdaanghari")->count();


            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_southdaanghari")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_southdaanghari")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            
            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_southdaanghari")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_southdaanghari")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_southdaanghari")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_southdaanghari")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                             
                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_southdaanghari")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_southdaanghari")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_southdaanghari")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_southdaanghari")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
         
        }
        elseif (($users->role == "barangay_southsignalvillage"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_southsignalvillage")->count();
         
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_southsignalvillage")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_southsignalvillage")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_southsignalvillage")->count();

            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_southsignalvillage")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_southsignalvillage")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            
            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_southsignalvillage")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_southsignalvillage")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_southsignalvillage")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_southsignalvillage")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                        
                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_southsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_southsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_southsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_southsignalvillage")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
            
        }
        elseif (($users->role == "barangay_tanyag"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_tanyag")->count();
      
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_tanyag")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_tanyag")
               ->count();
            
            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_tanyag")->count();

            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_tanyag")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_tanyag")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_tanyag")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_tanyag")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_tanyag")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_tanyag")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_tanyag")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_tanyag")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_tanyag")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_tanyag")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
        }
        elseif (($users->role == "barangay_upperbicutan"))
        {
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_upperbicutan")->count();
   
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_upperbicutan")->count();

            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_upperbicutan")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_upperbicutan")->count();

            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_upperbicutan")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_upperbicutan")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_upperbicutan")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

                $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_upperbicutan")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

                $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_upperbicutan")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

             $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_upperbicutan")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

                        $commoncrime = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_upperbicutan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotal = DB::table('barangay_reports')
                        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereMonth('date_reported', Carbon::now()->month)
                        ->where('barangay',"barangay_upperbicutan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
            
                        // dd($commoncrimetotal);
            
                        $commoncrimeyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_upperbicutan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('incident_type');
            
                        $commoncrimetotalyearly = DB::table('barangay_reports')
                        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
                        ->whereYear('date_reported', Carbon::now()->year)
                        ->where('barangay',"barangay_upperbicutan")
                        ->groupBy('incident_type', 'month')
                        ->orderBy('total', 'desc')
                        ->limit(10)
                        ->pluck('total');
        }
        elseif (($users->role == "barangay_westernbicutan"))
        {
 
            $totaldailyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereDate('date_reported', DB::raw('CURDATE()'))->where('barangay',"barangay_westernbicutan")->count();
 
            $totalmonthlyreports = DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereMonth('date_reported', date('m'))->where('barangay',"barangay_westernbicutan")->count();
            // dd($totalmonthlyreports );
            $totalweeklyreports= DB::table('barangay_reports')->whereYear('date_reported', Carbon::now()->year)->whereBetween('date_reported', 
               [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
               )
               ->where('barangay',"barangay_westernbicutan")
               ->count();

            $totalreports = DB::table('barangay_reports')->select('*')->where('barangay',"barangay_westernbicutan")->count();
            // dd($totalreports);

            $months =  DB::table('barangay_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck('month');
            // dd(  $months);

            // $barangayreports2023 =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_westernbicutan")
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            // $barangayreportspending =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_westernbicutan")
            // ->where('report_status', 'Pending')
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');
 
            // $barangayreportsresponded =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            // ->where('barangay',"barangay_westernbicutan")
            // ->where('report_status', 'Responded')
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');

            // $latest = DB::table('barangay_reports')->latest()->first();
            // $oldest = DB::table('barangay_reports')->oldest()->first();


            // $barangayreportstransferred =  DB::table('barangay_reports')
            // ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))  
            // ->where('barangay',"barangay_westernbicutan")
            // ->where('report_status', 'Transferred')
            // ->where('year_reported', '2023')
            // ->orderBy('date_reported')
            // ->groupBy('month')
            // ->pluck('total');  

            $barangayreports2023 = DB::table('barangay_reports')->select('id', 'date_reported')
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported', '2023')
            ->get()

            ->groupBy(function($date) {
            return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            });


                $numberreports = [];
                $totalallreports = [];

                foreach ($barangayreports2023 as $key => $value) {
                    $numberreports[(int)$key] = count($value);
                }

                for($i = 0; $i <= 12; $i++){
                    if(!empty($numberreports[$i])){
                        $totalallreports[$i] = $numberreports[$i];    
                    }else{
                        $totalallreports[$i] = 0;    
                    }
                }

             $barangayreportsresponded = DB::table('barangay_reports')->select('id', 'date_reported')
                ->where('barangay',"barangay_westernbicutan")
                ->where('report_status', 'Responded')
                ->where('year_reported', '2023')
                ->get()

                ->groupBy(function($date) {
                return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                });


                    $numberresponded = [];
                    $totalresponded = [];

                    foreach ($barangayreportsresponded as $key => $value) {
                        $numberresponded[(int)$key] = count($value);
                    }

                    for($i = 0; $i <= 12; $i++){
                        if(!empty($numberresponded[$i])){
                            $totalresponded[$i] = $numberresponded[$i];    
                        }else{
                            $totalresponded[$i] = 0;    
                        }
                    }

             $barangayreportspending = DB::table('barangay_reports')->select('id', 'date_reported')
                    ->where('barangay',"barangay_westernbicutan")
                    ->where('report_status', 'Pending')
                    ->where('year_reported', '2023')
                    ->get()
    
                    ->groupBy(function($date) {
                    return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                    });
    
    
                        $numberpending = [];
                        $totalpending = [];
    
                        foreach ($barangayreportspending as $key => $value) {
                            $numberpending[(int)$key] = count($value);
                        }
    
                        for($i = 0; $i <= 12; $i++){
                            if(!empty($numberpending[$i])){
                                $totalpending[$i] = $numberpending[$i];    
                            }else{
                                $totalpending[$i] = 0;    
                            }
                        }
    

            $barangayreportstransferred = DB::table('barangay_reports')->select('id', 'date_reported')
                  ->where('barangay',"barangay_westernbicutan")
                  ->where('report_status', 'Transferred')
                  ->where('year_reported', '2023')
                  ->get()
      
                  ->groupBy(function($date) {
                     return Carbon::parse($date->date_reported)->format('m'); // grouping by months
                  });
                  //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
                        $numbertransferred = [];
                        $totaltransferred = [];
      
                        foreach ($barangayreportstransferred as $key => $value) {
                           $numbertransferred[(int)$key] = count($value);
                        }
      
                        for($i = 0; $i <= 12; $i++){
                           if(!empty($numbertransferred[$i])){
                              $totaltransferred[$i] = $numbertransferred[$i];    
                           }else{
                              $totaltransferred[$i] = 0;    
                           }
                        }

            //   $commoncrime = DB::table('barangay_reports')->select('id', 'date_reported')
            //       ->where('barangay',"barangay_westernbicutan")
            //       ->where('report_status', 'Transferred')
            //       ->where('year_reported', '2023')
            //       ->get()
      
            //       ->groupBy(function($date) {
            //          return Carbon::parse($date->date_reported)->format('m'); // grouping by months
            //       });
            //       //   ->groupBy(DB::raw('MONTH(date_reported) as month'));
      
            //             $numbertransferred = [];
            //             $totaltransferred = [];
      
            //             foreach ($barangayreportstransferred as $key => $value) {
            //                $numbertransferred[(int)$key] = count($value);
            //             }
      
            //             for($i = 0; $i <= 12; $i++){
            //                if(!empty($numbertransferred[$i])){
            //                   $totaltransferred[$i] = $numbertransferred[$i];    
            //                }else{
            //                   $totaltransferred[$i] = 0;    
            //                }
            //             }

        // $commoncrime =  $totalmonthlyreports = DB::table('barangay_reports')
        // ->whereMonth('date_reported', date('m'))
        // ->where('barangay',"barangay_westernbicutan")
        // ->where('incident_type', 'Robbery')
        // ->where('year_reported', '2023')
        // ->count();

        //   $commoncrime = DB::table('barangay_reports')
        //     ->select(DB::raw('count(incident_type) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
        //     ->whereMonth('date_reported', date('m'))
        //     ->where('barangay',"barangay_westernbicutan")
        //     // ->where('incident_type', 'Robbery')
        //     ->where('year_reported', '2023')
        //     ->orderBy('date_reported')
        //     ->groupBy('month')
        //     // ->count();
        //     ->pluck('total','month');

            $commoncrime = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotal = DB::table('barangay_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            // dd($commoncrimetotal);

            $commoncrimeyearly = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('incident_type');

            $commoncrimetotalyearly = DB::table('barangay_reports')
            ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereYear('date_reported', Carbon::now()->year)    
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported', '2023')
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->pluck('total');

            // $numberofpending= DB::table('barangay_reports')
            // ->selectRaw('barangay, report_status, COUNT(report_status) as total')
            // ->whereYear('date_reported', Carbon::now()->year)    
            // ->where('year_reported', '2023')
            // ->where('report_status', 'Pending')
            // ->groupBy('report_status', 'barangay')
            // ->orderBy('total', 'desc')
            // // ->get();
            // ->pluck('total','barangay');
            // dd($numberofpending);

            // dd( $commoncrimeyearly,$commoncrimetotalyearly );


            // $commoncrime = DB::table('police_station_reports')
            // ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            // ->whereMonth('date_reported', date('m'))
            // ->where('year_reported', '2022')
            // ->groupBy('incident_type', 'month')
            // ->orderBy('total', 'desc')
            // ->pluck('incident_type');

            // $commoncrimetotal = DB::table('police_station_reports')
            // ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            // ->whereMonth('date_reported', date('m'))
            // ->where('year_reported', '2022')
            // ->groupBy('incident_type', 'month')
            // ->orderBy('total', 'desc')
            // ->pluck('total');

            // // dd($commoncrimetotal);

            // $commoncrimeyearly = DB::table('police_station_reports')
            // ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            // // ->whereMonth('date_reported', date('m'))
            // ->where('year_reported', '2022')
            // ->groupBy('incident_type', 'month')
            // ->orderBy('total', 'desc')
            // ->pluck('incident_type');

            // $commoncrimetotalyearly = DB::table('police_station_reports')
            // ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            // // ->whereMonth('date_reported', date('m'))
            // ->where('year_reported', '2022')
            // ->groupBy('incident_type', 'month')
            // ->orderBy('total', 'desc')
            // ->pluck('total');

            // $commoncrimeyearly = DB::table('police_station_reports')
            // ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            // // ->whereYear('date_reported', Carbon::now()->year)
            // ->where('year_reported', '2022')
            // ->groupBy('incident_type', 'month')
            // ->orderBy('total', 'desc')
            // // ->limit(10)
            // ->pluck('incident_type');

            // $commoncrimetotalyearly = DB::table('police_station_reports')
            // ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
            // // ->whereYear('date_reported', Carbon::now()->year)
            // ->where('year_reported', '2022')
            // ->groupBy('incident_type', 'month')
            // ->orderBy('total', 'desc')
            // // ->limit(10)
            // ->pluck('total');
                

        //  dd($totalresponded,$totalpending,$totaltransferred,$barangayreportspending,$totalallreports) ;
        } 

        return view('dashboard.barangay_dashboard',compact('barangayreports2023','months','totaldailyreports', 'totalmonthlyreports','totalweeklyreports','totalreports','barangayreportspending', 'barangayreportsresponded',
        'barangayreportstransferred','totalresponded','totalpending','totaltransferred','totalallreports','commoncrime','commoncrimetotal','commoncrimeyearly','commoncrimetotalyearly'));


    }


    
}
