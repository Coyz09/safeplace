<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Charts\PoliceSubstationReport;
use App\Charts\PoliceMonthlyReport2020;
use App\Charts\PoliceMonthlyReport2021;
use App\Charts\PoliceMonthlyReport2022;
use App\Charts\PoliceMonthlyReport2023;

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

        // $userss = User::select(\DB::raw("COUNT(*) as count"))
        // ->whereYear('created_at', date('Y'))
        // ->groupBy(\DB::raw("Month(created_at)"))
        // ->pluck('count');

      

    if (($users->role == "police_substation1"))
        {

        // $policereport =  DB::table('police_station_reports')
        //     ->groupBy('year_reported')
        //     ->pluck(DB::raw('count(year_reported) AS total'),'year_reported')
        //     ->all();

        $policereport2020 =  DB::table('police_station_reports')
        ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
        ->where('police_substation',"police_substation1")
        ->where('year_reported', '2020')
        ->orderBy('date_reported')
        ->groupBy('month')
        ->pluck(DB::raw('count(month) AS total'),'month')
        ->all();

        // dd($policereport);


        $policereport2020Chart = new PoliceSubstationReport;
     $dataset =  $policereport2020Chart->labels(array_keys($policereport2020));
       $dataset=  $policereport2020Chart->dataset('Monthly Reports 2020 Demographics', 'bar', array_values($policereport2020));
       $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
       $policereport2020Chart->options([
           'responsive' => true,
           'legend' => ['display' => true],
           'tooltips' => ['enabled'=>true],
           'aspectRatio' => 1,
           'scales' => [
               'yAxes'=> [[
                           'display'=>true,
                           'ticks'=> ['beginAtZero'=> true],
                           'gridLines'=> ['display'=> true],
                         ]],
               'xAxes'=> [[
                           'categoryPercentage'=> 0.8,
                           'barPercentage' => 1,
                           'ticks' => ['beginAtZero' => true],
                           'gridLines' => ['display' => true],
                           'display' => true
                         ]],
           ],
       ]);

       $policereport2021 =  DB::table('police_station_reports')
       ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
       ->where('police_substation',"police_substation1")
       ->where('year_reported', '2021')
       ->orderBy('date_reported')
       ->groupBy('month')
       ->pluck(DB::raw('count(month) AS total'),'month')
       ->all();

       // dd($policereport);


        $policereport2021Chart = new PoliceSubstationReport;
        $dataset =  $policereport2021Chart->labels(array_keys($policereport2021));
      $dataset=  $policereport2021Chart->dataset('Monthly Reports 2021 Demographics', 'pie', array_values($policereport2021));
      $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
      $policereport2021Chart->options([
          'responsive' => true,
          'legend' => ['display' => true],
          'tooltips' => ['enabled'=>true],
          'aspectRatio' => 1,
          'scales' => [
              'yAxes'=> [[
                          'display'=>false,
                          'ticks'=> ['beginAtZero'=> true],
                          'gridLines'=> ['display'=> false],
                        ]],
              'xAxes'=> [[
                          'categoryPercentage'=> 0.8,
                          'barPercentage' => 1,
                          'ticks' => ['beginAtZero' => false],
                          'gridLines' => ['display' => false],
                          'display' => true
                        ]],
          ],
      ]);

            
        $policereport2022 =  DB::table('police_station_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('police_substation',"police_substation1")
            ->where('year_reported', '2022')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck(DB::raw('count(month) AS total'),'month')
            ->all();
   
            // dd($policereport);


        $policereport2022Chart = new PoliceSubstationReport;
         $dataset =  $policereport2022Chart->labels(array_keys($policereport2022));
           $dataset=  $policereport2022Chart->dataset('Monthly Reports 2022 Demographics', 'pie', array_values($policereport2022 ));
           $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
           $policereport2022Chart->options([
               'responsive' => true,
               'legend' => ['display' => true],
               'tooltips' => ['enabled'=>true],
               'aspectRatio' => 1,
               'scales' => [
                   'yAxes'=> [[
                               'display'=>false,
                               'ticks'=> ['beginAtZero'=> true],
                               'gridLines'=> ['display'=> false],
                             ]],
                   'xAxes'=> [[
                               'categoryPercentage'=> 0.8,
                               'barPercentage' => 1,
                               'ticks' => ['beginAtZero' => false],
                               'gridLines' => ['display' => false],
                               'display' => true
                             ]],
               ],
           ]);

           $policereport2023 =  DB::table('police_station_reports')
           ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
           ->where('police_substation',"police_substation1")
           ->where('year_reported', '2023')
           ->orderBy('date_reported')
           ->groupBy('month')
           ->pluck(DB::raw('count(month) AS total'),'month')
           ->all();
  
           // dd($policereport);


       $policereport2023Chart = new PoliceSubstationReport;
        $dataset =  $policereport2023Chart->labels(array_keys($policereport2023));
          $dataset=  $policereport2023Chart->dataset('Monthly Reports 2023 Demographics', 'horizontalBar', array_values($policereport2023));
          $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
          $policereport2023Chart->options([
              'responsive' => true,
              'legend' => ['display' => true],
              'tooltips' => ['enabled'=>true],
              'aspectRatio' => 1,
              'scales' => [
                  'yAxes'=> [[
                              'display'=>true,
                              'ticks'=> ['beginAtZero'=> true],
                              'gridLines'=> ['display'=> true],
                            ]],
                  'xAxes'=> [[
                              'categoryPercentage'=> 0.8,
                              'barPercentage' => 1,
                              'ticks' => ['beginAtZero' => true],
                              'gridLines' => ['display' => true],
                              'display' => true
                            ]],
              ],
          ]);

        }


    elseif (($users->role == "police_substation2"))
        {

        // $policereport =  DB::table('police_station_reports')
        //     ->groupBy('year_reported')
        //     ->pluck(DB::raw('count(year_reported) AS total'),'year_reported')
        //     ->all();

        $policereport2020 =  DB::table('police_station_reports')
        ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
        ->where('police_substation',"police_substation2")
        ->where('year_reported', '2020')
        ->orderBy('date_reported')
        ->groupBy('month')
        ->pluck(DB::raw('count(month) AS total'),'month')
        ->all();

        // dd($policereport);


     $policereport2020Chart = new PoliceSubstationReport;
     $dataset =  $policereport2020Chart->labels(array_keys($policereport2020));
       $dataset=  $policereport2020Chart->dataset('Monthly Reports 2020 Demographics', 'bar', array_values($policereport2020));
       $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
       $policereport2020Chart->options([
           'responsive' => true,
           'legend' => ['display' => true],
           'tooltips' => ['enabled'=>true],
           'aspectRatio' => 1,
           'scales' => [
               'yAxes'=> [[
                           'display'=>true,
                           'ticks'=> ['beginAtZero'=> true],
                           'gridLines'=> ['display'=> true],
                         ]],
               'xAxes'=> [[
                           'categoryPercentage'=> 0.8,
                           'barPercentage' => 1,
                           'ticks' => ['beginAtZero' => true],
                           'gridLines' => ['display' => true],
                           'display' => true
                         ]],
           ],
       ]);

       $policereport2021 =  DB::table('police_station_reports')
       ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
       ->where('police_substation',"police_substation2")
       ->where('year_reported', '2021')
       ->orderBy('date_reported')
       ->groupBy('month')
       ->pluck(DB::raw('count(month) AS total'),'month')
       ->all();

       // dd($policereport);


            $policereport2021Chart = new PoliceSubstationReport;
            $dataset =  $policereport2021Chart->labels(array_keys($policereport2021));
            $dataset=  $policereport2021Chart->dataset('Monthly Reports 2021 Demographics', 'pie', array_values($policereport2021));
            $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
            $policereport2021Chart->options([
                'responsive' => true,
                'legend' => ['display' => true],
                'tooltips' => ['enabled'=>true],
                'aspectRatio' => 1,
                'scales' => [
                    'yAxes'=> [[
                                'display'=>false,
                                'ticks'=> ['beginAtZero'=> true],
                                'gridLines'=> ['display'=> false],
                                ]],
                    'xAxes'=> [[
                                'categoryPercentage'=> 0.8,
                                'barPercentage' => 1,
                                'ticks' => ['beginAtZero' => false],
                                'gridLines' => ['display' => false],
                                'display' => true
                                ]],
                ],
            ]);

                    
                $policereport2022 =  DB::table('police_station_reports')
                    ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                    ->where('police_substation',"police_substation2")
                    ->where('year_reported', '2022')
                    ->orderBy('date_reported')
                    ->groupBy('month')
                    ->pluck(DB::raw('count(month) AS total'),'month')
                    ->all();
        
                    // dd($policereport);


                $policereport2022Chart = new PoliceSubstationReport;
                $dataset =  $policereport2022Chart->labels(array_keys($policereport2022));
                $dataset=  $policereport2022Chart->dataset('Monthly Reports 2022 Demographics', 'pie', array_values($policereport2022 ));
                $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                $policereport2022Chart->options([
                    'responsive' => true,
                    'legend' => ['display' => true],
                    'tooltips' => ['enabled'=>true],
                    'aspectRatio' => 1,
                    'scales' => [
                        'yAxes'=> [[
                                    'display'=>false,
                                    'ticks'=> ['beginAtZero'=> true],
                                    'gridLines'=> ['display'=> false],
                                    ]],
                        'xAxes'=> [[
                                    'categoryPercentage'=> 0.8,
                                    'barPercentage' => 1,
                                    'ticks' => ['beginAtZero' => false],
                                    'gridLines' => ['display' => false],
                                    'display' => true
                                    ]],
                    ],
                ]);

                $policereport2023 =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation2")
                ->where('year_reported', '2023')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck(DB::raw('count(month) AS total'),'month')
                ->all();
        
                // dd($policereport);


            $policereport2023Chart = new PoliceSubstationReport;
                $dataset =  $policereport2023Chart->labels(array_keys($policereport2023));
                $dataset=  $policereport2023Chart->dataset('Monthly Reports 2023 Demographics', 'horizontalBar', array_values($policereport2023));
                $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                $policereport2023Chart->options([
                    'responsive' => true,
                    'legend' => ['display' => true],
                    'tooltips' => ['enabled'=>true],
                    'aspectRatio' => 1,
                    'scales' => [
                        'yAxes'=> [[
                                    'display'=>true,
                                    'ticks'=> ['beginAtZero'=> true],
                                    'gridLines'=> ['display'=> true],
                                    ]],
                        'xAxes'=> [[
                                    'categoryPercentage'=> 0.8,
                                    'barPercentage' => 1,
                                    'ticks' => ['beginAtZero' => true],
                                    'gridLines' => ['display' => true],
                                    'display' => true
                                    ]],
                    ],
                ]);

        }
                
                
        
    elseif (($users->role == "police_substation3"))
        {

        // $policereport =  DB::table('police_station_reports')
        //     ->groupBy('year_reported')
        //     ->pluck(DB::raw('count(year_reported) AS total'),'year_reported')
        //     ->all();

        $policereport2020 =  DB::table('police_station_reports')
        ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
        ->where('police_substation',"police_substation3")
        ->where('year_reported', '2020')
        ->orderBy('date_reported')
        ->groupBy('month')
        ->pluck(DB::raw('count(month) AS total'),'month')
        ->all();

        // dd($policereport);


     $policereport2020Chart = new PoliceSubstationReport;
     $dataset =  $policereport2020Chart->labels(array_keys($policereport2020));
       $dataset=  $policereport2020Chart->dataset('Monthly Reports 2020 Demographics', 'bar', array_values($policereport2020));
       $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
       $policereport2020Chart->options([
           'responsive' => true,
           'legend' => ['display' => true],
           'tooltips' => ['enabled'=>true],
           'aspectRatio' => 1,
           'scales' => [
               'yAxes'=> [[
                           'display'=>true,
                           'ticks'=> ['beginAtZero'=> true],
                           'gridLines'=> ['display'=> true],
                         ]],
               'xAxes'=> [[
                           'categoryPercentage'=> 0.8,
                           'barPercentage' => 1,
                           'ticks' => ['beginAtZero' => true],
                           'gridLines' => ['display' => true],
                           'display' => true
                         ]],
           ],
       ]);

       $policereport2021 =  DB::table('police_station_reports')
       ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
       ->where('police_substation',"police_substation3")
       ->where('year_reported', '2021')
       ->orderBy('date_reported')
       ->groupBy('month')
       ->pluck(DB::raw('count(month) AS total'),'month')
       ->all();

       // dd($policereport);


        $policereport2021Chart = new PoliceSubstationReport;
         $dataset =  $policereport2021Chart->labels(array_keys($policereport2021));
        $dataset=  $policereport2021Chart->dataset('Monthly Reports 2021 Demographics', 'pie', array_values($policereport2021));
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $policereport2021Chart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>false,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                            ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                            ]],
            ],
        ]);

                
            $policereport2022 =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation3")
                ->where('year_reported', '2022')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck(DB::raw('count(month) AS total'),'month')
                ->all();
    
                // dd($policereport);


            $policereport2022Chart = new PoliceSubstationReport;
            $dataset =  $policereport2022Chart->labels(array_keys($policereport2022));
            $dataset=  $policereport2022Chart->dataset('Monthly Reports 2022 Demographics', 'pie', array_values($policereport2022 ));
            $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
            $policereport2022Chart->options([
                'responsive' => true,
                'legend' => ['display' => true],
                'tooltips' => ['enabled'=>true],
                'aspectRatio' => 1,
                'scales' => [
                    'yAxes'=> [[
                                'display'=>false,
                                'ticks'=> ['beginAtZero'=> true],
                                'gridLines'=> ['display'=> false],
                                ]],
                    'xAxes'=> [[
                                'categoryPercentage'=> 0.8,
                                'barPercentage' => 1,
                                'ticks' => ['beginAtZero' => false],
                                'gridLines' => ['display' => false],
                                'display' => true
                                ]],
                ],
            ]);

            $policereport2023 =  DB::table('police_station_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('police_substation',"police_substation3")
            ->where('year_reported', '2023')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck(DB::raw('count(month) AS total'),'month')
            ->all();
    
            // dd($policereport);


        $policereport2023Chart = new PoliceSubstationReport;
            $dataset =  $policereport2023Chart->labels(array_keys($policereport2023));
            $dataset=  $policereport2023Chart->dataset('Monthly Reports 2023 Demographics', 'horizontalBar', array_values($policereport2023));
            $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
            $policereport2023Chart->options([
                'responsive' => true,
                'legend' => ['display' => true],
                'tooltips' => ['enabled'=>true],
                'aspectRatio' => 1,
                'scales' => [
                    'yAxes'=> [[
                                'display'=>true,
                                'ticks'=> ['beginAtZero'=> true],
                                'gridLines'=> ['display'=> true],
                                ]],
                    'xAxes'=> [[
                                'categoryPercentage'=> 0.8,
                                'barPercentage' => 1,
                                'ticks' => ['beginAtZero' => true],
                                'gridLines' => ['display' => true],
                                'display' => true
                                ]],
                ],
            ]);

            }            
   
    elseif (($users->role == "police_substation6"))
            {
    
            // $policereport =  DB::table('police_station_reports')
            //     ->groupBy('year_reported')
            //     ->pluck(DB::raw('count(year_reported) AS total'),'year_reported')
            //     ->all();
    
            $policereport2020 =  DB::table('police_station_reports')
            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
            ->where('police_substation',"police_substation6")
            ->where('year_reported', '2020')
            ->orderBy('date_reported')
            ->groupBy('month')
            ->pluck(DB::raw('count(month) AS total'),'month')
            ->all();
    
            // dd($policereport);
    
    
         $policereport2020Chart = new PoliceSubstationReport;
         $dataset =  $policereport2020Chart->labels(array_keys($policereport2020));
           $dataset=  $policereport2020Chart->dataset('Monthly Reports 2020 Demographics', 'bar', array_values($policereport2020));
           $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
           $policereport2020Chart->options([
               'responsive' => true,
               'legend' => ['display' => true],
               'tooltips' => ['enabled'=>true],
               'aspectRatio' => 1,
               'scales' => [
                   'yAxes'=> [[
                               'display'=>true,
                               'ticks'=> ['beginAtZero'=> true],
                               'gridLines'=> ['display'=> true],
                             ]],
                   'xAxes'=> [[
                               'categoryPercentage'=> 0.8,
                               'barPercentage' => 1,
                               'ticks' => ['beginAtZero' => true],
                               'gridLines' => ['display' => true],
                               'display' => true
                             ]],
               ],
           ]);
    
           $policereport2021 =  DB::table('police_station_reports')
           ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
           ->where('police_substation',"police_substation6")
           ->where('year_reported', '2021')
           ->orderBy('date_reported')
           ->groupBy('month')
           ->pluck(DB::raw('count(month) AS total'),'month')
           ->all();
    
           // dd($policereport);
    
    
            $policereport2021Chart = new PoliceSubstationReport;
             $dataset =  $policereport2021Chart->labels(array_keys($policereport2021));
            $dataset=  $policereport2021Chart->dataset('Monthly Reports 2021 Demographics', 'pie', array_values($policereport2021));
            $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
            $policereport2021Chart->options([
                'responsive' => true,
                'legend' => ['display' => true],
                'tooltips' => ['enabled'=>true],
                'aspectRatio' => 1,
                'scales' => [
                    'yAxes'=> [[
                                'display'=>false,
                                'ticks'=> ['beginAtZero'=> true],
                                'gridLines'=> ['display'=> false],
                                ]],
                    'xAxes'=> [[
                                'categoryPercentage'=> 0.8,
                                'barPercentage' => 1,
                                'ticks' => ['beginAtZero' => false],
                                'gridLines' => ['display' => false],
                                'display' => true
                                ]],
                ],
            ]);
    
                    
                $policereport2022 =  DB::table('police_station_reports')
                    ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                    ->where('police_substation',"police_substation6")
                    ->where('year_reported', '2022')
                    ->orderBy('date_reported')
                    ->groupBy('month')
                    ->pluck(DB::raw('count(month) AS total'),'month')
                    ->all();
        
                    // dd($policereport);
    
    
                $policereport2022Chart = new PoliceSubstationReport;
                $dataset =  $policereport2022Chart->labels(array_keys($policereport2022));
                $dataset=  $policereport2022Chart->dataset('Monthly Reports 2022 Demographics', 'pie', array_values($policereport2022 ));
                $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                $policereport2022Chart->options([
                    'responsive' => true,
                    'legend' => ['display' => true],
                    'tooltips' => ['enabled'=>true],
                    'aspectRatio' => 1,
                    'scales' => [
                        'yAxes'=> [[
                                    'display'=>false,
                                    'ticks'=> ['beginAtZero'=> true],
                                    'gridLines'=> ['display'=> false],
                                    ]],
                        'xAxes'=> [[
                                    'categoryPercentage'=> 0.8,
                                    'barPercentage' => 1,
                                    'ticks' => ['beginAtZero' => false],
                                    'gridLines' => ['display' => false],
                                    'display' => true
                                    ]],
                    ],
                ]);
    
                $policereport2023 =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation6")
                ->where('year_reported', '2023')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck(DB::raw('count(month) AS total'),'month')
                ->all();
        
                // dd($policereport);
    
    
            $policereport2023Chart = new PoliceSubstationReport;
                $dataset =  $policereport2023Chart->labels(array_keys($policereport2023));
                $dataset=  $policereport2023Chart->dataset('Monthly Reports 2023 Demographics', 'horizontalBar', array_values($policereport2023));
                $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                $policereport2023Chart->options([
                    'responsive' => true,
                    'legend' => ['display' => true],
                    'tooltips' => ['enabled'=>true],
                    'aspectRatio' => 1,
                    'scales' => [
                        'yAxes'=> [[
                                    'display'=>true,
                                    'ticks'=> ['beginAtZero'=> true],
                                    'gridLines'=> ['display'=> true],
                                    ]],
                        'xAxes'=> [[
                                    'categoryPercentage'=> 0.8,
                                    'barPercentage' => 1,
                                    'ticks' => ['beginAtZero' => true],
                                    'gridLines' => ['display' => true],
                                    'display' => true
                                    ]],
                    ],
                ]);
    
                }            
    elseif (($users->role == "police_substation7"))
                {
        
                // $policereport =  DB::table('police_station_reports')
                //     ->groupBy('year_reported')
                //     ->pluck(DB::raw('count(year_reported) AS total'),'year_reported')
                //     ->all();
        
                $policereport2020 =  DB::table('police_station_reports')
                ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                ->where('police_substation',"police_substation7")
                ->where('year_reported', '2020')
                ->orderBy('date_reported')
                ->groupBy('month')
                ->pluck(DB::raw('count(month) AS total'),'month')
                ->all();
        
                // dd($policereport);
        
        
             $policereport2020Chart = new PoliceSubstationReport;
             $dataset =  $policereport2020Chart->labels(array_keys($policereport2020));
               $dataset=  $policereport2020Chart->dataset('Monthly Reports 2020 Demographics', 'bar', array_values($policereport2020));
               $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
               $policereport2020Chart->options([
                   'responsive' => true,
                   'legend' => ['display' => true],
                   'tooltips' => ['enabled'=>true],
                   'aspectRatio' => 1,
                   'scales' => [
                       'yAxes'=> [[
                                   'display'=>true,
                                   'ticks'=> ['beginAtZero'=> true],
                                   'gridLines'=> ['display'=> true],
                                 ]],
                       'xAxes'=> [[
                                   'categoryPercentage'=> 0.8,
                                   'barPercentage' => 1,
                                   'ticks' => ['beginAtZero' => true],
                                   'gridLines' => ['display' => true],
                                   'display' => true
                                 ]],
                   ],
               ]);
        
               $policereport2021 =  DB::table('police_station_reports')
               ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
               ->where('police_substation',"police_substation7")
               ->where('year_reported', '2021')
               ->orderBy('date_reported')
               ->groupBy('month')
               ->pluck(DB::raw('count(month) AS total'),'month')
               ->all();
        
               // dd($policereport);
        
        
                $policereport2021Chart = new PoliceSubstationReport;
                 $dataset =  $policereport2021Chart->labels(array_keys($policereport2021));
                $dataset=  $policereport2021Chart->dataset('Monthly Reports 2021 Demographics', 'pie', array_values($policereport2021));
                $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                $policereport2021Chart->options([
                    'responsive' => true,
                    'legend' => ['display' => true],
                    'tooltips' => ['enabled'=>true],
                    'aspectRatio' => 1,
                    'scales' => [
                        'yAxes'=> [[
                                    'display'=>false,
                                    'ticks'=> ['beginAtZero'=> true],
                                    'gridLines'=> ['display'=> false],
                                    ]],
                        'xAxes'=> [[
                                    'categoryPercentage'=> 0.8,
                                    'barPercentage' => 1,
                                    'ticks' => ['beginAtZero' => false],
                                    'gridLines' => ['display' => false],
                                    'display' => true
                                    ]],
                    ],
                ]);
        
                        
                    $policereport2022 =  DB::table('police_station_reports')
                        ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                        ->where('police_substation',"police_substation7")
                        ->where('year_reported', '2022')
                        ->orderBy('date_reported')
                        ->groupBy('month')
                        ->pluck(DB::raw('count(month) AS total'),'month')
                        ->all();
            
                        // dd($policereport);
        
        
                    $policereport2022Chart = new PoliceSubstationReport;
                    $dataset =  $policereport2022Chart->labels(array_keys($policereport2022));
                    $dataset=  $policereport2022Chart->dataset('Monthly Reports 2022 Demographics', 'pie', array_values($policereport2022 ));
                    $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                    $policereport2022Chart->options([
                        'responsive' => true,
                        'legend' => ['display' => true],
                        'tooltips' => ['enabled'=>true],
                        'aspectRatio' => 1,
                        'scales' => [
                            'yAxes'=> [[
                                        'display'=>false,
                                        'ticks'=> ['beginAtZero'=> true],
                                        'gridLines'=> ['display'=> false],
                                        ]],
                            'xAxes'=> [[
                                        'categoryPercentage'=> 0.8,
                                        'barPercentage' => 1,
                                        'ticks' => ['beginAtZero' => false],
                                        'gridLines' => ['display' => false],
                                        'display' => true
                                        ]],
                        ],
                    ]);
        
                    $policereport2023 =  DB::table('police_station_reports')
                    ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                    ->where('police_substation',"police_substation7")
                    ->where('year_reported', '2023')
                    ->orderBy('date_reported')
                    ->groupBy('month')
                    ->pluck(DB::raw('count(month) AS total'),'month')
                    ->all();
            
                    // dd($policereport);
        
        
                $policereport2023Chart = new PoliceSubstationReport;
                    $dataset =  $policereport2023Chart->labels(array_keys($policereport2023));
                    $dataset=  $policereport2023Chart->dataset('Monthly Reports 2023 Demographics', 'horizontalBar', array_values($policereport2023));
                    $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                    $policereport2023Chart->options([
                        'responsive' => true,
                        'legend' => ['display' => true],
                        'tooltips' => ['enabled'=>true],
                        'aspectRatio' => 1,
                        'scales' => [
                            'yAxes'=> [[
                                        'display'=>true,
                                        'ticks'=> ['beginAtZero'=> true],
                                        'gridLines'=> ['display'=> true],
                                        ]],
                            'xAxes'=> [[
                                        'categoryPercentage'=> 0.8,
                                        'barPercentage' => 1,
                                        'ticks' => ['beginAtZero' => true],
                                        'gridLines' => ['display' => true],
                                        'display' => true
                                        ]],
                        ],
                    ]);
        
                    }            


    elseif (($users->role == "police_substation8"))
        {
            
                    // $policereport =  DB::table('police_station_reports')
                    //     ->groupBy('year_reported')
                    //     ->pluck(DB::raw('count(year_reported) AS total'),'year_reported')
                    //     ->all();
            
                    $policereport2020 =  DB::table('police_station_reports')
                    ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                    ->where('police_substation',"police_substation8")
                    ->where('year_reported', '2020')
                    ->orderBy('date_reported')
                    ->groupBy('month')
                    ->pluck(DB::raw('count(month) AS total'),'month')
                    ->all();
            
                    // dd($policereport);
            
            
                 $policereport2020Chart = new PoliceSubstationReport;
                 $dataset =  $policereport2020Chart->labels(array_keys($policereport2020));
                   $dataset=  $policereport2020Chart->dataset('Monthly Reports 2020 Demographics', 'bar', array_values($policereport2020));
                   $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                   $policereport2020Chart->options([
                       'responsive' => true,
                       'legend' => ['display' => true],
                       'tooltips' => ['enabled'=>true],
                       'aspectRatio' => 1,
                       'scales' => [
                           'yAxes'=> [[
                                       'display'=>true,
                                       'ticks'=> ['beginAtZero'=> true],
                                       'gridLines'=> ['display'=> true],
                                     ]],
                           'xAxes'=> [[
                                       'categoryPercentage'=> 0.8,
                                       'barPercentage' => 1,
                                       'ticks' => ['beginAtZero' => true],
                                       'gridLines' => ['display' => true],
                                       'display' => true
                                     ]],
                       ],
                   ]);
            
                   $policereport2021 =  DB::table('police_station_reports')
                   ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                   ->where('police_substation',"police_substation8")
                   ->where('year_reported', '2021')
                   ->orderBy('date_reported')
                   ->groupBy('month')
                   ->pluck(DB::raw('count(month) AS total'),'month')
                   ->all();
            
                   // dd($policereport);
            
            
                    $policereport2021Chart = new PoliceSubstationReport;
                     $dataset =  $policereport2021Chart->labels(array_keys($policereport2021));
                    $dataset=  $policereport2021Chart->dataset('Monthly Reports 2021 Demographics', 'pie', array_values($policereport2021));
                    $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                    $policereport2021Chart->options([
                        'responsive' => true,
                        'legend' => ['display' => true],
                        'tooltips' => ['enabled'=>true],
                        'aspectRatio' => 1,
                        'scales' => [
                            'yAxes'=> [[
                                        'display'=>false,
                                        'ticks'=> ['beginAtZero'=> true],
                                        'gridLines'=> ['display'=> false],
                                        ]],
                            'xAxes'=> [[
                                        'categoryPercentage'=> 0.8,
                                        'barPercentage' => 1,
                                        'ticks' => ['beginAtZero' => false],
                                        'gridLines' => ['display' => false],
                                        'display' => true
                                        ]],
                        ],
                    ]);
            
                            
                        $policereport2022 =  DB::table('police_station_reports')
                            ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                            ->where('police_substation',"police_substation8")
                            ->where('year_reported', '2022')
                            ->orderBy('date_reported')
                            ->groupBy('month')
                            ->pluck(DB::raw('count(month) AS total'),'month')
                            ->all();
                
                            // dd($policereport);
            
            
                        $policereport2022Chart = new PoliceSubstationReport;
                        $dataset =  $policereport2022Chart->labels(array_keys($policereport2022));
                        $dataset=  $policereport2022Chart->dataset('Monthly Reports 2022 Demographics', 'pie', array_values($policereport2022 ));
                        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                        $policereport2022Chart->options([
                            'responsive' => true,
                            'legend' => ['display' => true],
                            'tooltips' => ['enabled'=>true],
                            'aspectRatio' => 1,
                            'scales' => [
                                'yAxes'=> [[
                                            'display'=>false,
                                            'ticks'=> ['beginAtZero'=> true],
                                            'gridLines'=> ['display'=> false],
                                            ]],
                                'xAxes'=> [[
                                            'categoryPercentage'=> 0.8,
                                            'barPercentage' => 1,
                                            'ticks' => ['beginAtZero' => false],
                                            'gridLines' => ['display' => false],
                                            'display' => true
                                            ]],
                            ],
                        ]);
            
                        $policereport2023 =  DB::table('police_station_reports')
                        ->select(DB::raw('count(date_reported) AS total'),DB::raw('MONTHNAME(date_reported) as month'))
                        ->where('police_substation',"police_substation8")
                        ->where('year_reported', '2023')
                        ->orderBy('date_reported')
                        ->groupBy('month')
                        ->pluck(DB::raw('count(month) AS total'),'month')
                        ->all();
                
                        // dd($policereport);
            
            
                    $policereport2023Chart = new PoliceSubstationReport;
                        $dataset =  $policereport2023Chart->labels(array_keys($policereport2023));
                        $dataset=  $policereport2023Chart->dataset('Monthly Reports 2023 Demographics', 'horizontalBar', array_values($policereport2023));
                        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
                        $policereport2023Chart->options([
                            'responsive' => true,
                            'legend' => ['display' => true],
                            'tooltips' => ['enabled'=>true],
                            'aspectRatio' => 1,
                            'scales' => [
                                'yAxes'=> [[
                                            'display'=>true,
                                            'ticks'=> ['beginAtZero'=> true],
                                            'gridLines'=> ['display'=> true],
                                            ]],
                                'xAxes'=> [[
                                            'categoryPercentage'=> 0.8,
                                            'barPercentage' => 1,
                                            'ticks' => ['beginAtZero' => true],
                                            'gridLines' => ['display' => true],
                                            'display' => true
                                            ]],
                            ],
                        ]);
            
                        }            
                 
    

    return view('dashboard.policestation_dashboard',compact('policereport2020Chart','policereport2021Chart','policereport2022Chart','policereport2023Chart'));
}
}















@extends('layouts.base')
@include('partials.sidebar2')

@section('body')
<div class="container-xl" style = "margin-left: 120px;">
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <!-- <h1 class="mt-4">Admin Dashboard</h1> -->
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> -->
                        <div class="row">
                        <div class="col">
                            <h2 class="text-info">Dashboard /
                                <small class="text-muted">Police Substation Dashboard</small>
                            </h2>
                        </div>
                        </div>
                    
                        <!-- <div class="row">
                        <div  class="col-6">
                            <h2>Monthly Reports(2020) Demographics</h2>
                        @if(empty($policereport2020Chart))
                            <div id="app2"></div>
                        @else
                            <div id="app2">{!! $policereport2020Chart->container() !!}</div>
                            {!! $policereport2020Chart->script() !!}
                        @endif   
                 
                        <div class="col">
                            <h2>Monthly Reports(2021) Demographics</h2>
                        @if(empty($policereport2021Chart))
                            <div id="app2"></div>
                        @else
                            <div id="app2">{!! $policereport2021Chart->container() !!}</div>
                            {!! $policereport2021Chart->script() !!}
                        @endif   
                    </div> -->

                    
                <div class="row">
                    <div  class="col-6">
                            <h2>Monthly Reports(2020)</h2>
                        @if(empty($policereport2020Chart))
                            <div id="app2"></div>
                        @else
                            <div id="app2">{!! $policereport2020Chart->container() !!}</div>
                            {!! $policereport2020Chart->script() !!}
                        @endif   
                    </div>

 
                    <div class="col">
                            <h2>Monthly Reports(2021)</h2>
                        @if(empty($policereport2021Chart))
                            <div id="app2"></div>
                        @else
                            <div id="app2">{!! $policereport2021Chart->container() !!}</div>
                            {!! $policereport2021Chart->script() !!}
                        @endif   
                    </div>
                </div>

                <div class="row">
                    <div  class="col-6">
                            <h2>Monthly Reports(2022)</h2>
                        @if(empty($policereport2022Chart))
                            <div id="app2"></div>
                        @else
                            <div id="app2">{!! $policereport2022Chart->container() !!}</div>
                            {!! $policereport2022Chart->script() !!}
                        @endif   
                    </div>

 
                    <div class="col">
                            <h2>Monthly Reports(2023)</h2>
                        @if(empty($policereport2023Chart))
                            <div id="app2"></div>
                        @else
                            <div id="app2">{!! $policereport2023Chart->container() !!}</div>
                            {!! $policereport2023Chart->script() !!}
                        @endif   
                    </div>
                </div>
                    
</div>
</div>
@endsection



@extends('layouts.base')
@include('partials.sidebar2')

@section('body')

<div class="container-xl" style = "margin-left: 120px;">
<!-- <div id="layoutSidenav_content"> -->
<!-- <div id="hight-chart"></div> -->


<select class="year" id="year">
  <option value=''>Year</option>
  
  <option value="2020">2020</option>
  <option value="2021">2021</option>
  <option value="2022">2022</option>
  <option value="2023">2023</option>
  <!-- <option value="2019">2019</option>
  <option value="2018">2018</option> -->
</select>

<!-- <div class="container" id="container" style="min-width: 400px; height: 400px; margin: 0 auto"> </div>-->
<div class="container" id="container"></div>



</div>

<script type="text/javascript">
   
    var reportss2020 =  <?php echo json_encode($policereports2020) ?>;
    var reportss2021 =  <?php echo json_encode($policereports2021) ?>;
    var reportss2022 =  <?php echo json_encode($policereports2022) ?>;
    var reportss2023 =  <?php echo json_encode($policereports2023) ?>;
    var users =  <?php echo json_encode($userss) ?>;

    const data = {
    general: users,
    2020: reportss2020,
    2021: reportss2021,
    2022: reportss2022,
    2023: reportss2023,
    }
   
    const chart =  Highcharts.chart('container', {
        // chart: {
        //         renderTo: 'container',
        //         zoomType: 'x',
        //         spacingRight: 20
        //     },

        // chart: {
        //     type: 'column'
        // },
        
        title: {
            text: 'Reports by year'
        },
        subtitle: {
            text: ''
        },
         xAxis: {

            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            
        },
        yAxis: {
          
            title: {
                text: 'Number of Reports'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        tooltip: {
                shared: true
            },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            type: 'column',
            name: 'Reports',
            data: reportss2020,    
            // keys: ['name', 'x']
        }],
     
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
        
        
});

$( document ).ready(function() {
        document.getElementById('year').addEventListener('change', function(e) {
        if (e.target.value) {
            // chart.series[0].setData(data[e.target.value]);
            chart.series[0].update({
                data: data[e.target.value]
            }, false, false, false);
            chart.redraw();
        } 
        else {
            chart.series[0].setData(data.general);
            chart.redraw();
        }

        
        });
    });
 

</script>

@endsection



<!-- {!! Form::open(['route' => 'import', 'files' => true]) !!}
{{ csrf_field() }}


<div class="title">Import</div>

<div class="user-details">

<div class="input-box">
      <div class="form-group">
        {!!Form::label('Excel:')!!}
        {!! Form::file('excel_file',old('excel_file'),['class' => 'form-control'])!!}
      </div>
    </div>
</div>

<div class="button">
{{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
</div>
{!! Form::close() !!} -->


