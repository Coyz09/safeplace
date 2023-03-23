<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangayReports;
use App\Models\User;

use DB;
use Auth;
use Hash;
use JWTAuth;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Mail;
use Illuminate\Support\Carbon;

class Barangay_ReportAPIController extends Controller
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
        //     'report_details' =>'required',
        //     'report_images' =>'required',
        // ]);

        $user = User::find(Auth::user()->id);
        $userdetails = DB::table('verified_users')
        ->join('users', 'verified_users.user_id',  '=', 'users.id')
        ->select('verified_users.*','users.img')
        ->where('verified_users.user_id', '=',  $user->id)->first();



        $age = Carbon::parse($userdetails->birthdate)->age;

        $todayTime = Carbon::now()->format('H:i:m');
        $todayDate = Carbon::now()->format('Y-m-d');

        if($request->hasFile('report_images')){
            // $images = $request->report_images;

            foreach($request->file('report_images') as $images ){
                $img = $images->getClientOriginalName();
                // $imageName =$img.'storage/images/'.time().'.jpg';
                $imageName =time().$img;
                // $input['img'] = 'storage/images/'.$img;
                $images->move(public_path('storage/images'), $imageName);

                $data[] = $imageName ;
            }



        }

        //Report Details
        $barangayreport = new BarangayReports;
        $barangayreport ->barangay= $request->barangay;
        $barangayreport ->street= $request->street;
        $barangayreport ->report_details= $request->report_details;
        $barangayreport ->report_images= json_encode($data,JSON_UNESCAPED_SLASHES);
        $barangayreport ->report_status= "Pending";
        $barangayreport ->incident_type= $request->incident_type;

        // //Reported Date and time
        $barangayreport  ->date_reported= $todayDate;
        $barangayreport  ->time_reported= $todayTime;
        $barangayreport  ->year_reported= "2023";
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
        $barangayreport ->save();


        return response()->json([
            'success' => true,
            'report' => $barangayreport,
            'user' => $user,
            'userdetails'=>  $userdetails,
            // 'report_images'=> $imageName,

        ]);


}



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
