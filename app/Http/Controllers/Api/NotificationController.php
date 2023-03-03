<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use Auth;
use DB;

class NotificationController extends Controller
{
    public function user_notification(Request $request){

        $user = User::find(Auth::user()->id);


        $notification = DB::table('notifications')
        ->join('users', 'notifications.user_id',  '=', 'users.id')
        ->select('notifications.*')
        ->where('notifications.user_id', '=',  $user->id )->get();


        return response()->json([
            'success' => true,
            'user' => $user,
            'notification' => $notification,
        ]);




    }
}
