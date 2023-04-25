<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangayReports;
use App\Models\PoliceStationReports;
use App\Models\User;
use App\Models\VerifiedUser;
use App\Models\Notification;

use DB;
use Auth;
use Hash;
use JWTAuth;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Mail;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    //Barangay Report Function
    public function barangay_report(Request $request){


        $user = User::find(Auth::user()->id);
        $userdetails = DB::table('verified_users')
        ->join('users', 'verified_users.user_id',  '=', 'users.id')
        ->select('verified_users.*','users.img')
        ->where('verified_users.user_id', '=',  $user->id)->first();



        $age = Carbon::parse($userdetails->birthdate)->age;

        $todayTime = Carbon::now()->format('H:i:m');
        $todayDate = Carbon::now()->format('Y-m-d');
        $todayYear = Carbon::now()->format('Y');





        //Report Details
        $barangayreport = new BarangayReports;
        $barangayreport ->barangay= $request->barangay;
        $barangayreport ->street= $request->street;
        $barangayreport ->report_details= $request->report_details;
        $barangayreport ->report_status= "Pending";
        $barangayreport ->incident_type= $request->incident_type;

        // //Reported Date and time
        $barangayreport  ->date_reported= $todayDate;
        $barangayreport  ->time_reported= $todayTime;
        $barangayreport  ->year_reported= $todayYear;
        $barangayreport  ->date_commited= $request->date_commited;
        $barangayreport  ->time_commited= $request->time_commited;

        // //Complainant Details
        $barangayreport  ->complainant_id= $userdetails->id;
        $barangayreport  ->complainant_name= $user->name;
        $barangayreport  ->complainant_address= $userdetails->address;
        $barangayreport  ->complainant_gender= $userdetails->gender;
        $barangayreport  ->complainant_age= $age;
        $barangayreport  ->complainant_contact= $userdetails->contact;
        $barangayreport  ->complainant_email= $userdetails->email;
        $barangayreport  ->complainant_identity= $request->complainant_identity;




        $report_images_1 = '';

        if($request->report_images_1!=''){
            $randomString1 = Str::random(7);
            $report_images_1 = 'storage/reports/'.$randomString1.'.jpg';
            file_put_contents($report_images_1,base64_decode($request->report_images_1));
            $barangayreport->report_images_1 = $report_images_1;
        }

        $report_images_2 = '';

        if($request->report_images_2!=''){
            $randomString2 = Str::random(7);
            $report_images_2 = 'storage/reports/'.$randomString2.'.jpg';
            file_put_contents($report_images_2,base64_decode($request->report_images_2));
            $barangayreport->report_images_2 = $report_images_2;
        }


        $report_images_3 = '';

        if($request->report_images_3!=''){
            $randomString3 = Str::random(7);
            $report_images_3 = 'storage/reports/'.$randomString3.'.jpg';
            file_put_contents($report_images_3,base64_decode($request->report_images_3));
            $barangayreport->report_images_3 = $report_images_3;
        }

        $barangayreport ->save();

        // $notification_message = "Your report is send! Please wait for the update. Thank you!";
        $notification_message = "Your report has send, With the report ID of ".$barangayreport->id.". Please wait for the update. Thank you!";

        $notification_status = "unread";

        $notification = Notification::create([
            'message' =>  $notification_message,
            'status' =>  $notification_status,
            'user_id' =>$user->id,
         ]);
         $notification->save();



            $barangay  = DB::table('barangay_accounts')
            // ->join('users', 'verified_users.user_id',  '=', 'users.id')
            ->select('user_id')
            ->where('role', '=',  $request->barangay)
            ->first();


            if($request->complainant_identity == "not anonymous"){
                $barangay_notification_message= $user->name." has sent a report, With the report ID of ".$barangayreport->id.". Please respond!";
            }
            elseif($request->complainant_identity == "anonymous")
            {
                $barangay_notification_message= "An anonymous person has sent a report, With the report ID of ".$barangayreport->id.". Please respond!";
            }


            $barangay_notification_status = "unread";

            $notification = Notification::create([
                'message' =>  $barangay_notification_message,
                'status' =>  $barangay_notification_status,
                'user_id' =>$barangay->user_id,
            ]);
            $notification->save();




        return response()->json([
            'success' => true,
            'report' => $barangayreport,
            'user' => $user,
            'userdetails'=>  $userdetails,
            // 'report_images'=> $imageName,

        ]);

    }


    //Police Station Function
    public function police_report(Request $request){


        $user = User::find(Auth::user()->id);

        $userdetails = DB::table('verified_users')
        ->join('users', 'verified_users.user_id',  '=', 'users.id')
        ->select('verified_users.*','users.img')
        ->where('verified_users.user_id', '=',  $user->id)->first();



        $age = Carbon::parse($userdetails->birthdate)->age;
        $todayTime = Carbon::now()->format('H:i:m');
        $todayDate = Carbon::now()->format('Y-m-d');
        $todayYear = Carbon::now()->format('Y');



        //Report Details
        $policesubstationreport = new PoliceStationReports;
        $policesubstationreport ->barangay= $request->barangay;
        $policesubstationreport ->street= $request->street;
        $policesubstationreport ->police_substation= $request->police_substation;
        $policesubstationreport ->report_details= $request->report_details;
        $policesubstationreport ->report_status= "Pending";
        $policesubstationreport ->incident_type= $request->incident_type;

        // //Reported Date and time
        $policesubstationreport ->date_reported= $todayDate;
        $policesubstationreport ->time_reported= $todayTime;
        $policesubstationreport ->year_reported= $todayYear;
        $policesubstationreport ->date_commited= $request->date_commited;
        $policesubstationreport ->time_commited= $request->time_commited;

        // //Complainant Details
        $policesubstationreport ->complainant_id= $userdetails->id;
        $policesubstationreport ->complainant_name= $user->name;
        $policesubstationreport ->complainant_address= $userdetails->address;
        $policesubstationreport ->complainant_gender= $userdetails->gender;
        $policesubstationreport ->complainant_age= $age;
        $policesubstationreport ->complainant_contact= $userdetails->contact;
        $policesubstationreport ->complainant_email= $userdetails->email;
        $policesubstationreport ->complainant_identity= $request->complainant_identity;



        $report_images_1 = '';

        if($request->report_images_1!=''){
            $randomString1 = Str::random(7);
            $report_images_1 = 'storage/reports/'.$randomString1.'.jpg';
            file_put_contents($report_images_1,base64_decode($request->report_images_1));
            $policesubstationreport->report_images_1 = $report_images_1;
        }

        $report_images_2 = '';

        if($request->report_images_2!=''){
            $randomString2 = Str::random(7);
            $report_images_2 = 'storage/reports/'.$randomString2.'.jpg';
            file_put_contents($report_images_2,base64_decode($request->report_images_2));
            $policesubstationreport->report_images_2 = $report_images_2;
        }


        $report_images_3 = '';

        if($request->report_images_3!=''){
            $randomString3 = Str::random(7);
            $report_images_3 = 'storage/reports/'.$randomString3.'.jpg';
            file_put_contents($report_images_3,base64_decode($request->report_images_3));
            $policesubstationreport->report_images_3 = $report_images_3;
        }


        $policesubstationreport ->save();

        // dd($policesubstationreport -> id);

        $notification_message = "Your report has sent, With the report ID of ".$policesubstationreport->id.". Please wait for the update. Thank you!";

        $notification_status = "unread";

        $notification = Notification::create([
            'message' =>  $notification_message,
            'status' =>  $notification_status,
            'user_id' =>$user->id,
         ]);
         $notification->save();



        // if($request->police_substation == "police_substation1")
        // {


            $police  = DB::table('police_station_accounts')
            // ->join('users', 'verified_users.user_id',  '=', 'users.id')
            ->select('user_id')
            ->where('role', '=',  $request->police_substation)
            ->first();


            if($request->complainant_identity == "not anonymous"){
                $police_notification_message= $user->name." has sent a report, With the report ID of ".$policesubstationreport->id.". Please respond!";
            }
            elseif($request->complainant_identity == "anonymous")
            {
                $police_notification_message= "An anonymous person has sent a report, With the report ID of ".$policesubstationreport->id.". Please respond!";
            }


            $police_notification_status = "unread";

            $notification = Notification::create([
                'message' =>  $police_notification_message,
                'status' =>  $police_notification_status,
                'user_id' =>$police->user_id,
            ]);
            $notification->save();

            // dd($police);
        // }

        // dd($years);

        return response()->json([
            'success' => true,
            'report' => $policesubstationreport,
            'user' => $user,
            'userdetails'=>  $userdetails,
            // 'report_images'=> $imageName,

        ]);


    }


    public function view_reports(Request $request){

        $user = User::find(Auth::user()->id);

        $verified = DB::table('verified_users')
        ->join('users', 'verified_users.user_id',  '=', 'users.id')
        ->select('verified_users.id')
        ->where('verified_users.user_id', '=',  $user->id)
        ->first();


        $barangay = DB::table('barangay_reports')
        ->join('verified_users', 'barangay_reports.complainant_id',  '=', 'verified_users.id')
        ->select('barangay_reports.*')
        ->orderBy('barangay_reports.date_reported', 'DESC')
        ->orderBy('barangay_reports.time_reported', 'DESC')
        ->where('barangay_reports.complainant_id', '=',  $verified->id )
        ->get();


        $police_station = DB::table('police_station_reports')
        ->join('verified_users', 'police_station_reports.complainant_id',  '=', 'verified_users.id')
        ->select('police_station_reports.*')
        ->orderBy('police_station_reports.date_reported', 'DESC')
        ->orderBy('police_station_reports.time_reported', 'DESC')
        ->where('police_station_reports.complainant_id', '=',  $verified->id )
        ->get();




        return response()->json([
            'success' => true,
            'user' => $user,
            'reports' => $barangay->merge($police_station),
        ]);

    }


    //Police Sub Staion Top Crime per Year
    public function psub_common_crime_year(Request $request){

        //Sub 1
        $police_substation1 = DB::table('police_station_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->where('police_substation',"police_substation1")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        //Sub 2
        $police_substation2 = DB::table('police_station_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->where('police_substation',"police_substation2")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        //Sub 3
        $police_substation3 = DB::table('police_station_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->where('police_substation',"police_substation3")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        //Sub 4
        $police_substation6 = DB::table('police_station_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->where('police_substation',"police_substation6")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        //Sub 5
        $police_substation7 = DB::table('police_station_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->where('police_substation',"police_substation7")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        //Sub 6
        $police_substation8 = DB::table('police_station_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->where('police_substation',"police_substation8")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        return response()->json([
            'success' => true,
            'policesub1' => $police_substation1,
            'policesub2' => $police_substation2,
            'policesub3' => $police_substation3,
            'policesub6' => $police_substation6,
            'policesub7' => $police_substation7,
            'policesub8' => $police_substation8,


        ]);


    }

    //Police Sub Staion Top Crime per Month of Current Year
    public function psub_common_crime_month(Request $request){

        $police_substation1 = DB::table('police_station_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('police_substation',"police_substation1")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $police_substation2 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation2")
            ->where('year_reported', Carbon::now()->year)
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();


        $police_substation3 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation3")
            ->where('year_reported', Carbon::now()->year)
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();


        $police_substation6 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation6")
            ->where('year_reported', Carbon::now()->year)
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        $police_substation7 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation7")
            ->where('year_reported', Carbon::now()->year)
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        $police_substation8 = DB::table('police_station_reports')
            ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
            ->whereMonth('date_reported', Carbon::now()->month)
            ->where('police_substation',"police_substation8")
            ->where('year_reported', Carbon::now()->year)
            ->groupBy('incident_type', 'month')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();


        return response()->json([
            'success' => true,
            'policesub1' => $police_substation1,
            'policesub2' => $police_substation2,
            'policesub3' => $police_substation3,
            'policesub6' => $police_substation6,
            'policesub7' => $police_substation7,
            'policesub8' => $police_substation8,

        ]);


    }


    //Barangay Top Crime per Year
    public function brgy_common_crime_year(Request $request){

        $barangay_centralbicutan = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_centralbicutan")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_centralsignalvillage = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_centralsignalvillage")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_fortbonifacio = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_fortbonifacio")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_katuparan = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_katuparan")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_maharlikavillage = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_maharlikavillage")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        $barangay_northdaanghari = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_northdaanghari")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        $barangay_northsignalvillage = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_northsignalvillage")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_pinagsama = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_pinagsama")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_southdaanghari = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_southdaanghari")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_southsignalvillage = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_southsignalvillage")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_tanyag = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_tanyag")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        $barangay_upperbicutan = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_upperbicutan")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_westernbicutan = DB::table('barangay_reports')
        ->selectRaw('YEAR(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereYear('date_reported', Carbon::now()->year)
        ->where('barangay',"barangay_westernbicutan")
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();






        return response()->json([
            'success' => true,
            'barangay_centralbicutan' => $barangay_centralbicutan,
            'barangay_centralsignalvillage' => $barangay_centralsignalvillage,
            'barangay_fortbonifacio' => $barangay_fortbonifacio,
            'barangay_katuparan' => $barangay_katuparan,
            'barangay_maharlikavillage' => $barangay_maharlikavillage,
            'barangay_northdaanghari' => $barangay_northdaanghari,
            'barangay_northsignalvillage' => $barangay_northsignalvillage,
            'barangay_pinagsama' => $barangay_pinagsama,
            'barangay_southdaanghari' => $barangay_southdaanghari,
            'barangay_southsignalvillage' => $barangay_southsignalvillage,
            'barangay_tanyag' => $barangay_tanyag,

            'barangay_upperbicutan' => $barangay_upperbicutan,
            'barangay_westernbicutan' => $barangay_westernbicutan,


        ]);


    }


    //Barangay Top Crime per Month of Current Year
    public function brgy_common_crime_month(Request $request){

        $barangay_centralbicutan = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_centralbicutan")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        


        $barangay_centralsignalvillage = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_centralsignalvillage")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        $barangay_fortbonifacio = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_fortbonifacio")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        $barangay_katuparan = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_katuparan")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        $barangay_maharlikavillage = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_maharlikavillage")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        $barangay_northdaanghari = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_northdaanghari")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();


        $barangay_northsignalvillage = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_northsignalvillage")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_pinagsama = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_pinagsama")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_southdaanghari = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_southdaanghari")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_southsignalvillage = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_southsignalvillage")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_tanyag = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_tanyag")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_upperbicutan = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_upperbicutan")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();

        $barangay_westernbicutan = DB::table('barangay_reports')
        ->selectRaw('MONTH(date_reported) as month, incident_type, COUNT(incident_type) as total')
        ->whereMonth('date_reported', Carbon::now()->month)
        ->where('barangay',"barangay_westernbicutan")
        ->where('year_reported', Carbon::now()->year)
        ->groupBy('incident_type', 'month')
        ->orderBy('total', 'desc')
        ->limit(10)
        ->get();




        return response()->json([
            'success' => true,
            'barangay_centralbicutan' => $barangay_centralbicutan,
            'barangay_centralsignalvillage' => $barangay_centralsignalvillage,
            'barangay_fortbonifacio' => $barangay_fortbonifacio,
            'barangay_katuparan' => $barangay_katuparan,
            'barangay_maharlikavillage' => $barangay_maharlikavillage,
            'barangay_northdaanghari' => $barangay_northdaanghari,
            'barangay_northsignalvillage' => $barangay_northsignalvillage,
            'barangay_pinagsama' => $barangay_pinagsama,
            'barangay_southdaanghari' => $barangay_southdaanghari,
            'barangay_southsignalvillage' => $barangay_southsignalvillage,
            'barangay_tanyag' => $barangay_tanyag,
            'barangay_upperbicutan' => $barangay_upperbicutan,
            'barangay_westernbicutan' => $barangay_westernbicutan,
        ]);




    }


}
