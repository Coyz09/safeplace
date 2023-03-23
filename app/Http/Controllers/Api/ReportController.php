<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangayReports;
use App\Models\PoliceStationReports;
use App\Models\User;
use App\Models\VerifiedUser;


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
        ->where('barangay_reports.complainant_id', '=',  $verified->id )
        ->get();


        $police_station = DB::table('police_station_reports')
        ->join('verified_users', 'police_station_reports.complainant_id',  '=', 'verified_users.id')
        ->select('police_station_reports.*')
        ->where('police_station_reports.complainant_id', '=',  $verified->id )
        ->get();




        return response()->json([
            'success' => true,
            'user' => $user,
            'reports' => $barangay->merge($police_station),
        ]);

    }





}
