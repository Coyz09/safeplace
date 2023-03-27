<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnverifiedUser;
use App\Models\User;
use App\Models\Notification;

use DB;
use Auth;
use Hash;
use JWTAuth;
use Validator;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    public function verification_frontId(Request $request){


        $user = User::find(Auth::user()->id);

        $id_picture_front = '';

        $file_name = Str::random(10);


        if($request->id_picture_front!=''){
            $id_picture_front = 'storage/images/'.$file_name.'.jpg';
            file_put_contents($id_picture_front,base64_decode($request->id_picture_front));

            $user = DB::table('unverified_users')
            ->join('users', 'unverified_users.user_id',  '=', 'users.id')
            ->select('unverified_users.user_id')
            ->where('unverified_users.user_id', '=',  $user->id )
            ->update([

                'id_picture_front'=> $user->id_picture_front = $id_picture_front

            ]);

        }

        return response()->json([
            'success' => true,
            'id_picture_front' => $id_picture_front,
        ]);



    }


    public function verification_backId(Request $request){


        $user = User::find(Auth::user()->id);

        $id_picture_back = '';

        $file_name = Str::random(10);


        if($request->id_picture_back!=''){
            $id_picture_back = 'storage/images/'.$file_name.'.jpg';
            file_put_contents($id_picture_back,base64_decode($request->id_picture_back));

            $user = DB::table('unverified_users')
            ->join('users', 'unverified_users.user_id',  '=', 'users.id')
            ->select('unverified_users.user_id')
            ->where('unverified_users.user_id', '=',  $user->id )
            ->update([

                'id_picture_back'=> $user->id_picture_back = $id_picture_back

            ]);

        }

        return response()->json([
            'success' => true,
            'id_picture_back' => $id_picture_back,
        ]);


    }


    public function verification_faceImage(Request $request){

        $user = User::find(Auth::user()->id);

        $face_img = '';

        $file_name = Str::random(10);


        if($request->face_img!=''){
            $face_img = 'storage/images/'.$file_name.'.jpg';
            file_put_contents($face_img,base64_decode($request->face_img));

            $user = DB::table('unverified_users')
            ->join('users', 'unverified_users.user_id',  '=', 'users.id')
            ->select('unverified_users.user_id')
            ->where('unverified_users.user_id', '=',  $user->id )
            ->update([

                'face_img'=> $user->face_img = $face_img,
                'status'=>'Pending'

            ]);

        }

        $userID = User::find(Auth::user()->id);

        $notification_message = "Your Request for verification is already in process. Please wait for it to be processed.";
        $notification_status = "unread";

        $notification = Notification::create([
            'message' =>  $notification_message,
            'status' =>  $notification_status,
            'user_id' =>$userID->id,
         ]);
         $notification->save();

        return response()->json([
            'success' => true,
            'face_img' => $face_img,
        ]);


    }



    public function verification_idDetails(Request $request){

        $user = User::find(Auth::user()->id);


        $unverified_user = DB::table('unverified_users')
        ->join('users', 'unverified_users.user_id',  '=', 'users.id')
        ->select('unverified_users.user_id')
        ->where('unverified_users.user_id', '=',  $user->id )
        ->update([
            'id_type'=>$request->id_type,
            'id_number'=>$request->id_number,
        ]);

        $user = DB::table('unverified_users')
        ->join('users', 'unverified_users.user_id',  '=', 'users.id')
        ->select('unverified_users.*')
        ->where('unverified_users.user_id', '=',  $user->id )->get();

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);


    }


    public function update_information(Request $request){

        $user = User::find(Auth::user()->id);



        $unverified_user = DB::table('unverified_users')
        ->join('users', 'unverified_users.user_id',  '=', 'users.id')
        ->select('unverified_users.user_id')
        ->where('unverified_users.user_id', '=',  $user->id )
        ->update([

            'fname'=>$request->fname,
            'mname'=>$request->mname,
            'lname'=>$request->lname,

            'gender'=>$request->gender,

            'birthdate'=>$request->birthdate,

            'address'=>$request->address,

            'contact'=>$request->contact
        ]);

        $name = $request->fname.' '.$request->mname.' '.$request->lname;
        $user->name = $name;
        $user->update();


        $user = DB::table('unverified_users')
        ->join('users', 'unverified_users.user_id',  '=', 'users.id')
        ->select('unverified_users.*')
        ->where('unverified_users.user_id', '=',  $user->id )->get();



        return response()->json([
            'success' => true,
            'user' => $user,
            'unverified_user' => $unverified_user,
        ]);



    }

}
