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



class UserBarangayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = DB::table('users')
        ->join('barangay_accounts','users.id','=','barangay_accounts.user_id')
        ->select('users.name','barangay_accounts.role')
        ->where('barangay_accounts.user_id',(auth()->guard('web')->user()->id))
        ->get();

            if (($users[0]->role == "barangay_centralbicutan"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_centralbicutan")
                ->get();
            }
            elseif (($users[0]->role == "barangay_centralsignalvillage"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_centralsignalvillage")
                ->get();
            }
    
            elseif (($users[0]->role == "barangay_fortbonifacio"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_fortbonifacio")
                ->get();
              
            }
            elseif (($users[0]->role == "barangay_katuparan"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_katuparan")
                ->get();
              
            }
            elseif (($users[0]->role == "barangay_maharlikavillage"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_maharlikavillage")
                ->get();
               
            }
            elseif (($users[0]->role == "barangay_northdaanghari"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_northdaanghari")
                ->get();
               
            }
            elseif (($users[0]->role == "barangay_northsignalvillage"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_northsignalvillage")
                ->get();
              
            }
            elseif (($users[0]->role == "barangay_pinagsama"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_pinagsama")
                ->get();
              
            }
            elseif (($users[0]->role == "barangay_southdaanghari"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_southdaanghari")
                ->get();
             
            }
            elseif (($users[0]->role == "barangay_southsignalvillage"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_southsignalvillage")
                ->get();
                
            }
            elseif (($users[0]->role == "barangay_tanyag"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_tanyag")
                ->get();
                
            }
            elseif (($users[0]->role == "barangay_upperbicutan"))
            {
                $barangay_reports = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_upperbicutan")
                ->get();
            }
            elseif (($users[0]->role == "barangay_westernbicutan"))
            {
                $barangay_reports  = DB::table('barangay_reports')
                ->select('*')
                ->where('barangay',"barangay_westernbicutan")
                ->get();
                // dd($barangay_reports);
            }

        return View::make('barangay_users.index',compact('barangay_reports','users'));
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
        //     ->where('barangay',"barangay_westernbicutan")
        //     ->get();
        // $barangay_reports = BarangayReports::select('*')->where('barangay','barangay_westernbicutan')->get();
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
            ->where('barangay',"barangay_centralbicutan")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }
        elseif (($users->role == "barangay_centralsignalvillage"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_centralsignalvillage")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        
        }

        elseif (($users->role == "barangay_fortbonifacio"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_fortbonifacio")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
          
        }
        elseif (($users->role == "barangay_katuparan"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_katuparan")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
          
        }
        elseif (($users->role == "barangay_maharlikavillage"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_maharlikavillage")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
           
        }
        elseif (($users->role == "barangay_northdaanghari"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_northdaanghari")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
           
        }
        elseif (($users->role == "barangay_northsignalvillage"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_northsignalvillage")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
          
        }
        elseif (($users->role == "barangay_pinagsama"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_pinagsama")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
          
        }
        elseif (($users->role == "barangay_southdaanghari"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_southdaanghari")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
         
        }
        elseif (($users->role == "barangay_southsignalvillage"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_southsignalvillage")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
            
        }
        elseif (($users->role == "barangay_tanyag"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_tanyag")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
            
        }
        elseif (($users->role == "barangay_upperbicutan"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_upperbicutan")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();
        }
        elseif (($users->role == "barangay_westernbicutan"))
        {
            $barangay_reports =  $users = DB::table('barangay_reports')
            ->select('*')
            ->where('barangay',"barangay_westernbicutan")
            ->where('year_reported',"2023")
            ->orderBy('id', 'DESC')
            ->orderBy('date_reported', 'DESC')
            ->orderBy('time_reported', 'DESC')
            ->get();

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
        $barangay_reports -> update(['report_status'=>'Responded']);
        return Redirect::to('/barangay_user')->with('success','Barangay Reports updated!');

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


    public function transfer(Request $request, $id)
    {
        $barangay_reports = BarangayReports::find($id);

        //Report Details
         $policesubstationreport = new PoliceStationReports;
         $policesubstationreport ->barangay= $barangay_reports->barangay;
         $policesubstationreport ->street= $barangay_reports->street;
         $policesubstationreport ->police_substation= $request->police_substation;
         $policesubstationreport ->report_details= $barangay_reports->report_details;
         $policesubstationreport ->report_status= "Pending";
         $policesubstationreport ->incident_type= $barangay_reports->incident_type;
 
         // //Reported Date and time
         $policesubstationreport ->date_reported= $barangay_reports->date_reported;
         $policesubstationreport ->time_reported= $barangay_reports->time_reported;
         $policesubstationreport ->year_reported= $barangay_reports->year_reported;
         $policesubstationreport ->date_commited= $barangay_reports->date_commited;
         $policesubstationreport ->time_commited= $barangay_reports->time_commited;

            // //Complainant Details
            $policesubstationreport ->complainant_id= $barangay_reports->complainant_id;
            $policesubstationreport ->complainant_name= $barangay_reports->complainant_name;
            $policesubstationreport ->complainant_address= $barangay_reports->complainant_address;
            $policesubstationreport ->complainant_gender= $barangay_reports->complainant_gender;
            $policesubstationreport ->complainant_age= $barangay_reports->complainant_age;
            $policesubstationreport ->complainant_contact= $barangay_reports->complainant_contact;
            $policesubstationreport ->complainant_email= $barangay_reports->complainant_email;
            $policesubstationreport ->complainant_identity= $barangay_reports->complainant_identity;

        //Report Images
        $policesubstationreport->report_images_1 = $barangay_reports ->report_images_1;
        $policesubstationreport->report_images_2 = $barangay_reports ->report_images_2;
        $policesubstationreport->report_images_3 = $barangay_reports ->report_images_3;

        $policesubstationreport ->save();

        $barangay_reports ->update(['report_status'=>'Transferred']);


        $barangay  = DB::table('barangay_accounts')
                ->select('user_id')
                ->where('role', '=',   $barangay_reports->barangay)
                ->first();

            //    dd($barangay);

        $user = User::find($barangay->user_id);

        $police = DB::table('police_station_accounts')
                ->select('user_id')
                ->where('role', '=',   $request->police_substation)
                ->first();

                // dd( $barangay);

        $police_notification_message= $user->name." has transferred a report, With the report ID of ".$policesubstationreport->id.". Please respond!";
        $police_notification_status = "unread";

        $notification = Notification::create([
            'message' =>  $police_notification_message,
            'status' =>  $police_notification_status,
            'user_id' => $police->user_id,
        ]);
        $notification->save();


        return Redirect::to('/barangay_user')->with('success','Barangay Report Transferred!');
    }

 


    public function notifications()
    {
        $users = DB::table('users')
        ->join('barangay_accounts','users.id','=','barangay_accounts.user_id')
        ->select('users.name','barangay_accounts.role','users.id' )
        ->where('barangay_accounts.user_id',(auth()->guard('web')->user()->id))
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

        return View::make('barangay_users.barangay_notif',compact('users','notifications'));
    }

        public function markNotification(Request $request)
        {

            $barangay_reports = Notification::find($request->input('id'));
            $barangay_reports-> update(['status'=>'read']);
            return response()->noContent();


        }
}
