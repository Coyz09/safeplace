<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PoliceStationReports;
use App\Models\User;
use App\Models\PoliceSubstation;

use DB;
use Auth;
use Hash;
use JWTAuth;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Mail;
use Illuminate\Support\Carbon;

class PoliceSubstation_ReportAPIController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // $request->validate([
        //     'barangay' =>'required',
        //     'police_substation' =>'required',
        //     'report_details' =>'required',
        //     'report_images' =>'required',
        // ]);

        $user = User::find(Auth::user()->id);
        $userdetails = DB::table('verified_users')
        ->join('users', 'verified_users.user_id',  '=', 'users.id')
        ->select('verified_users.*','users.img')
        ->where('verified_users.user_id', '=',  $user->id)->first();
        // dd($userdetails[0]->birthdate);


        // $age = Carbon::parse($userdetails->birthdate)->age;

        // $todayTime = Carbon::now()->format('H:i:m');
        // $todayDate = Carbon::now()->format('Y-m-d');



        // if($request->hasFile('report_images')){
        //     // $images = $request->report_images;

        //     foreach($request->file('report_images') as $images ){
        //         $img = $images->getClientOriginalName();

        //         $imageName =time().$img;

        //         $images->move(public_path('storage/images'), $imageName);

        //         $data[] = $imageName ;
        //     }

        // }

        // //Report Details
        // $policesubstationreport = new PoliceStationReports;
        // $policesubstationreport ->barangay= $request->barangay;
        // $policesubstationreport ->street= $request->street;
        // $policesubstationreport ->police_substation= $request->police_substation;
        // $policesubstationreport ->report_details= $request->report_details;
        // $policesubstationreport ->report_images= json_encode($data,JSON_UNESCAPED_SLASHES);
        // $policesubstationreport ->report_status= "Pending";
        // $policesubstationreport ->incident_type= $request->incident_type;

        // // //Reported Date and time
        // $policesubstationreport ->date_reported= $todayDate;
        // $policesubstationreport ->time_reported= $todayTime;
        // $policesubstationreport ->year_reported= "2023";
        // $policesubstationreport ->date_commited= $request->date_commited;
        // $policesubstationreport ->time_commited= $request->time_commited;

        // // //Complainant Details
        // $policesubstationreport ->complainant_id= $userdetails->id;
        // $policesubstationreport ->complainant_name= $user->name;
        // $policesubstationreport ->complainant_address= $userdetails->address;
        // $policesubstationreport ->complainant_gender= $userdetails->gender;
        // $policesubstationreport ->complainant_age= $age;
        // $policesubstationreport ->complainant_contact= $userdetails->contact;
        // $policesubstationreport ->complainant_email= $userdetails->email;
        // $policesubstationreport ->complainant_identity= $request->complainant_identity;
        // $policesubstationreport ->save();
        // dd($years);



        if($request->police_substation == "police_substation1")
        {
        

            $police  = DB::table('police_station_accounts')
            // ->join('users', 'verified_users.user_id',  '=', 'users.id')
            ->select('user_id')
            ->where('role', '=',  $request->police_substation)
            ->first();
            dd($police);
        }


       

        return response()->json([
            'success' => true,
            'report' => $policesubstationreport,
            'user' => $user,
            'userdetails'=>  $userdetails,
            // 'report_images'=> $imageName,

        ]);
    }


    // public function uploadImage(Request $request){
    //     $user = User::find(Auth::user()->id);
    //     $userdetails = DB::table('verified_users')
    //     ->join('users', 'verified_users.user_id',  '=', 'users.id')
    //     ->select('verified_users.*','users.img')
    //     ->where('verified_users.user_id', '=',  $user->id)->first();

    //     if($request->hasFile('report_images')){
    //         // $images = $request->report_images;

    //         foreach($request->file('report_images') as $images ){
    //             $img = $images->getClientOriginalName();

    //             $imageName =time().$img;

    //             $images->move(public_path('storage/images'), $imageName);

    //             $data[] = $imageName ;
    //         }

    //     }


    //     $policesubstationreport = new PoliceStationReports;
    //     $policesubstationreport ->report_images= json_encode($data,JSON_UNESCAPED_SLASHES);
    //     $policesubstationreport ->save();


    //     return response()->json([
    //         'success' => true,
    //         'report' => $policesubstationreport,
    //         // 'report_images'=> $imageName,

    //     ]);

    // }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
