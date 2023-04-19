<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CallLog;


use Auth;
use DB;
use Carbon\Carbon;



class CallLogController extends Controller
{
    public function barangay_call_log(Request $request){

        $user = User::find(Auth::user()->id);

        $usercontact = DB::table('verified_users')
        ->join('users', 'verified_users.user_id',  '=', 'users.id')
        ->select('verified_users.*','users.img','users.role')
        ->where('verified_users.user_id', '=',  $user->id )
        ->first();
      // dd( $usercontact);

        $date = Carbon::today()->format('F j, Y');
       
        $time = Carbon::now()->format('g:i A');

        $type = "barangay";



        $call_log = CallLog::create([
            'user_name' => $user->name,
            'user_contact' => $usercontact->contact,
            'name_contacted' => $request->name_contacted,
            'type_contacted' => $type,
            'date_contacted' => $date,
            'time_contacted' => $time,
            'user_id' => $user->id,


        ]);

        $user->save();


        return response()->json([
            'success' => true,
            'user' => $user,
            'usercontact' => $usercontact 
        ]);



    }

    public function police_call_log(Request $request){

        $user = User::find(Auth::user()->id);
        $usercontact = DB::table('verified_users')
        ->join('users', 'verified_users.user_id',  '=', 'users.id')
        ->select('verified_users.*','users.img','users.role')
        ->where('verified_users.user_id', '=',  $user->id )
        ->first();

        $date = Carbon::today()->format('F j, Y');



        $time = Carbon::now()->format('g:i A');

        $type = "police_station";



        $call_log = CallLog::create([
            'user_name' => $user->name,
            'user_contact' => $usercontact->contact,
            'name_contacted' => $request->name_contacted,
            'type_contacted' => $type,
            'date_contacted' => $date,
            'time_contacted' => $time,
            'user_id' => $user->id,


        ]);

        $user->save();


        return response()->json([
            'success' => true,
            'user' => $user,
            'usercontact' => $usercontact 
        ]);



    }


    public function user_call_log(Request $request){

        $user = User::find(Auth::user()->id);

        $call_log = DB::table('call_logs')
        ->join('users', 'call_logs.user_id',  '=', 'users.id')
        ->select('call_logs.*')
        ->orderBy('call_logs.date_contacted', 'DESC')
        ->orderBy('call_logs.time_contacted', 'DESC')
        ->where('call_logs.user_id', '=',  $user->id )
        ->get();

        return response()->json([
            'success' => true,
            'user' => $user,
            'call_log' => $call_log,
        ]);

    }
}
