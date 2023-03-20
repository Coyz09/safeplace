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
        $users = DB::table('users')
        ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
        ->select('users.name','police_station_accounts.role' )
        ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
        ->get();
  

            if (($users[0]->role == "police_substation1"))
            {
                $police_reports  = DB::table('police_station_reports')
                ->select('year_reported')
                ->where('police_substation',"police_substation1")
                ->get();
            }

            elseif (($users[0]->role == "police_substation2"))
            {
                $police_reports = DB::table('police_station_reports')
                ->select('year_reported')
                ->where('police_substation',"police_substation2")
                ->get();
            }

            elseif (($users[0]->role == "police_substation3"))
            {
                $police_reports = DB::table('police_station_reports')
                ->select('year_reported')
                ->where('police_substation',"police_substation3")
                ->get();
            }
            // dd(  $police_reports );

        return View::make('policestation_users.index',compact('police_reports','users'));
    }

    public function reports2022()
    {
        $users = DB::table('users')
        ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
        ->select('users.name','police_station_accounts.role' )
        ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
        ->get();


           

        return View::make('policestation_users.report_2022',compact('users'));
    }

    public function reports2021()
    {
        $users = DB::table('users')
        ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
        ->select('users.name','police_station_accounts.role' )
        ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
        ->get();
   

           

        return View::make('policestation_users.report_2021',compact('users'));
    }

    public function reports2020()
    {
        $users = DB::table('users')
        ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
        ->select('users.name','police_station_accounts.role' )
        ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
        ->get();
   

           

        return View::make('policestation_users.report_2020',compact('users'));
    }


    public function getPoliceStationReports()
    {
        $users = DB::table('users')
            ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
            ->select('police_station_accounts.role')
            ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
            ->first();
        //    dd($users);

        if (($users->role == "police_substation1"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation1")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation2"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation2")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
          
            ->get();
        }

        elseif (($users->role == "police_substation3"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation3")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation6"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation6")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation7"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation7")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }
        elseif (($users->role == "police_substation8"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation8")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        return  Datatables::of($police_reports)
        ->addColumn('action', 'policestation_users.action')
        ->make();
    }


    public function getPoliceStationReports2022()
    {
        $users = DB::table('users')
            ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
            ->select('police_station_accounts.role')
            ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
            ->first();
        //    dd($users);

        if (($users->role == "police_substation1"))
        {
            
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation1")
            ->where('year_reported',"2022")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation2"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation2")
            ->where('year_reported',"2022")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
          
            ->get();
        }

        elseif (($users->role == "police_substation3"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation3")
            ->where('year_reported',"2022")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation6"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation6")
            ->where('year_reported',"2022")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation7"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation7")
            ->where('year_reported',"2022")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }
        elseif (($users->role == "police_substation8"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation8")
            ->where('year_reported',"2022")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        // $police_reports = PoliceStationReports::select('*');
        return  Datatables::of($police_reports)
        ->addColumn('action', 'policestation_users.action')
        ->make();
    }

    public function getPoliceStationReports2021()
    {
        $users = DB::table('users')
            ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
            ->select('police_station_accounts.role')
            ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
            ->first();
        //    dd($users);

        if (($users->role == "police_substation1"))
        {
            
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation1")
            ->where('year_reported',"2021")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation2"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation2")
            ->where('year_reported',"2021")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
          
            ->get();
        }

        elseif (($users->role == "police_substation3"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation3")
            ->where('year_reported',"2021")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation6"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation6")
            ->where('year_reported',"2021")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation7"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation7")
            ->where('year_reported',"2021")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }
        elseif (($users->role == "police_substation8"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation8")
            ->where('year_reported',"2021")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        // $police_reports = PoliceStationReports::select('*');
        return  Datatables::of($police_reports)
        ->addColumn('action', 'policestation_users.action')
        ->make();
    }

    public function getPoliceStationReports2020()
    {
        $users = DB::table('users')
            ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
            ->select('police_station_accounts.role')
            ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
            ->first();
        //    dd($users);

        if (($users->role == "police_substation1"))
        {
            
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation1")
            ->where('year_reported',"2020")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation2"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation2")
            ->where('year_reported',"2020")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
          
            ->get();
        }

        elseif (($users->role == "police_substation3"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation3")
            ->where('year_reported',"2020")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation6"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation6")
            ->where('year_reported',"2020")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        elseif (($users->role == "police_substation7"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation7")
            ->where('year_reported',"2020")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }
        elseif (($users->role == "police_substation8"))
        {
            $police_reports =  $users = DB::table('police_station_reports')
            ->select('*')
            ->where('police_substation',"police_substation8")
            ->where('year_reported',"2020")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }

        // $police_reports = PoliceStationReports::select('*');
        return  Datatables::of($police_reports)
        ->addColumn('action', 'policestation_users.action')
        ->make();
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $police_reports = DB::table('police_station_reports')
        ->select('police_station_reports.*')
        ->get();

        $police_reports = PoliceStationReports::find($id);


        // dd($police_reports);
        return view('policestation_users.report_details',compact('police_reports'));
    }

    public function edit($id)
    {
        $police_reports = PoliceStationReports::find($id);
        return View::make('policestation_users.report_details',compact('police_reports'));
    }


    public function update(Request $request, $id)
    {
        $police_reports = PoliceStationReports::find($id);
        $police_reports ->update($request->all());
        return Redirect::to('/policestation_user')->with('success','Police Station Reports Updated!');
    }

 
    public function destroy($id)
    {
        //
    }
}
