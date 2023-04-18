<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\PoliceStationReports;
use App\Models\Notification;
use App\Models\BarangayReports;
use App\Models\User;
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
                ->select('year_reported','report_status')
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

            elseif (($users[0]->role == "police_substation6"))
            {
                $police_reports = DB::table('police_station_reports')
                ->select('year_reported')
                ->where('police_substation',"police_substation6")
                ->get();
            }
            elseif (($users[0]->role == "police_substation7"))
            {
                $police_reports = DB::table('police_station_reports')
                ->select('year_reported')
                ->where('police_substation',"police_substation7")
                ->get();
            }
            elseif (($users[0]->role == "police_substation8"))
            {
                $police_reports = DB::table('police_station_reports')
                ->select('year_reported')
                ->where('police_substation',"police_substation8")
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
        ->addColumn('action', 'policestation_users.action1')
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
        ->addColumn('action', 'policestation_users.action1')
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
        ->addColumn('action', 'policestation_users.action1')
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

    public function showyearly($id)
    {
        $police_reports = DB::table('police_station_reports')
        ->select('police_station_reports.*')
        ->get();

        $police_reports = PoliceStationReports::find($id);


        // dd($police_reports);
        return view('policestation_users.report_details_yearly',compact('police_reports'));
    }


    public function edit($id)
    {
        $police_reports = PoliceStationReports::find($id);
        return View::make('policestation_users.report_details',compact('police_reports'));
    }


    public function update(Request $request, $id)
    {
        $police_reports = PoliceStationReports::find($id);
        $police_reports-> update(['report_status'=>'Responded']);
        return Redirect::to('/policestation_user')->with('success','Police Station Reports Updated!');
    }

    public function transfer(Request $request, $id)
    {
        $police_reports = PoliceStationReports::find($id);
        // dd($police_reports);

         //Report Details
         $barangayreport = new BarangayReports;
         $barangayreport ->barangay= $police_reports ->barangay;
         $barangayreport ->street= $police_reports ->street;
         $barangayreport ->report_details= $police_reports ->report_details;
         $barangayreport ->report_status= "Pending";
         $barangayreport ->incident_type= $police_reports ->incident_type;
 
         // //Reported Date and time
         $barangayreport  ->date_reported= $police_reports ->date_reported ;
         $barangayreport  ->time_reported= $police_reports ->time_reported ;
         $barangayreport  ->year_reported= $police_reports ->year_reported;
         $barangayreport  ->date_commited= $police_reports ->date_commited;
         $barangayreport  ->time_commited= $police_reports ->time_commited;
 
         // //Complainant Details
         $barangayreport  ->complainant_id= $police_reports->complainant_id;
         $barangayreport  ->complainant_name= $police_reports->complainant_name;
         $barangayreport  ->complainant_address= $police_reports->complainant_address;
         $barangayreport  ->complainant_gender= $police_reports->complainant_gender;
         $barangayreport  ->complainant_age= $police_reports->complainant_age;
         $barangayreport  ->complainant_contact= $police_reports->complainant_contact;
         $barangayreport  ->complainant_email= $police_reports->complainant_email;
         $barangayreport  ->complainant_identity= $police_reports->complainant_identity;

         //Report Images
         $barangayreport->report_images_1 = $police_reports ->report_images_1;
         $barangayreport->report_images_2 = $police_reports ->report_images_2;
         $barangayreport->report_images_3 = $police_reports ->report_images_3;

        $barangayreport ->save();

        $police_reports ->update(['report_status'=>'Transferred']);


        $police  = DB::table('police_station_accounts')
                ->select('user_id')
                ->where('role', '=',   $police_reports->police_substation)
                ->first();

        $user = User::find($police->user_id);

        $barangay = DB::table('barangay_accounts')
                ->select('user_id')
                ->where('role', '=',   $police_reports->barangay)
                ->first();

                // dd( $barangay);

        $barangay_notification_message= $user->name." has transferred a report, With the report ID of ".$barangayreport->id.". Please respond!";
        $barangay_notification_status = "unread";

        $notification = Notification::create([
            'message' =>  $barangay_notification_message,
            'status' =>  $barangay_notification_status,
            'user_id' => $barangay->user_id,
        ]);
        $notification->save();



        return Redirect::to('/policestation_user')->with('success','Police Station Reports Updated!');
    }

 
    public function destroy($id)
    {
        //
    }


    public function notifications()
    {
        $users = DB::table('users')
        ->join('police_station_accounts','users.id','=','police_station_accounts.user_id')
        ->select('users.name','police_station_accounts.role','users.id' )
        ->where('police_station_accounts.user_id',(auth()->guard('web')->user()->id))
        ->get();
  
        // if($users[0]->role == "police_substation1")
        // {
             $notifications =DB::table('notifications')
            ->select('*')
            ->where('user_id', '=',  $users[0]->id)
            ->orderBy('created_at','desc')
            ->get();

        // }


            //   dd(  $notifications );

        return View::make('policestation_users.police_notif',compact('users','notifications'));
    }

        public function markNotification(Request $request)
        {

            $police_reports = Notification::find($request->input('id'));
            $police_reports-> update(['status'=>'read']);
            return response()->noContent();


        }

}
