<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnverifiedUser;
use App\Models\User;
use App\Models\PasswordReset;


use DB;
use Auth;
use Hash;
use JWTAuth;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Mail;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $token = auth()->guard('api')->attempt($credentials);
        // dd($token);

        if ($token) {

            if (auth()->guard('api')->user()->role == 'admin') {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                ]);
            }

            elseif (auth()->guard('api')->user()->role == 'superadmin') {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                ]);
            }

            elseif (auth()->guard('api')->user()->role == 'barangay') {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                ]);
            }

            // elseif (auth()->guard('api')->user()->role == 'police') {
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'Unauthorized',
            //     ]);
            // }

            else{


                $user = User::find(Auth::user()->id);

                if($user->role == "verified_user")
                {
                    $user = DB::table('verified_users')
                    ->join('users', 'verified_users.user_id',  '=', 'users.id')
                    ->select('verified_users.*','users.img')
                    ->where('verified_users.user_id', '=',  $user->id )->get();
                }
                elseif($user->role == "unverified_user"){
                $user = DB::table('unverified_users')
                    ->join('users', 'unverified_users.user_id',  '=', 'users.id')
                    ->select('unverified_users.*','users.img')
                    ->where('unverified_users.user_id', '=',  $user->id )->get();
                }

                // $user = DB::table('unverified_users')
                // ->join('users', 'unverified_users.user_id',  '=', 'users.id')
                // ->select('unverified_users.*','users.img')
                // ->where('unverified_users.user_id', '=',  $user->id )->get();

                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => $user,
                    'expires_in' => auth()->factory()->getTTL()*60

                ]);
            }
        }

        else{
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credentials',
            ]);
        }

    }

    public function qrcode(Request $request)
    {
        $qr_code = $request->only('qr_code');

        $userinfo= DB::table('users')
           ->select('*')
           ->where('qr_code', '=',  $qr_code)
           ->first();

        if ($userinfo){

            $useraccount = User::where('qr_code',$userinfo->qr_code)->first();

            // if ($useraccount)
            // {
                $token = Auth::guard('api')->login($useraccount);
                // dd($token);
                if($userinfo->role == "verified_user")
                    {
                        $user = DB::table('verified_users')
                        ->join('users', 'verified_users.user_id',  '=', 'users.id')
                        ->select('verified_users.*','users.img')
                        ->where('verified_users.user_id', '=',  $userinfo->id )->get();
                    }
                elseif($userinfo->role == "unverified_user")
                    {
                        $user = DB::table('unverified_users')
                        ->join('users', 'unverified_users.user_id',  '=', 'users.id')
                        ->select('unverified_users.*','users.img')
                        ->where('unverified_users.user_id', '=',  $userinfo->id )->get();
                    }

                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => $user,
                    'userinfo' => $userinfo,
                    'expires_in' => auth()->factory()->getTTL()*60

                ]);
       // }
       }

       else{
           return response()->json([
               'status' => false,
               'message' => 'Invalid Credentials',
           ]);
       }
    }

    public function register(Request $request) {

        $encryptedPass = Hash::make($request->password);

        $user = new User;
        $unverified_user = new UnverifiedUser;


        try{

            $user = User::create([
                'name' => $request->fname.' '.$request->mname.' '.$request->lname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'unverified_user',
            ]);
            $user->save();

            $unverified_user->user_id = $user->id;
            $unverified_user->fname = $request->fname;
            $unverified_user->mname = $request->mname;
            $unverified_user->lname = $request->lname;
            $unverified_user->email = $request->email;


            $unverified_user->status = 'Unverified';
            $unverified_user->save();


            return $this->login($request);



        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }


    }

    public function logout(Request $request){
        try{
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => 'logout success'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => ''.$e
            ]);
        }
    }

    public function save_user_info(Request $request){
            $user = User::find(Auth::user()->id);

            $img = '';

            if($request->img!=''){
                $img = 'storage/images/'.time().'.jpg';
                file_put_contents($img,base64_decode($request->img));
                $user->img = $img;
            }
            $user->update();



            $unverified_user = DB::table('unverified_users')
            ->join('users', 'unverified_users.user_id',  '=', 'users.id')
            ->select('unverified_users.user_id')
            ->where('unverified_users.user_id', '=',  $user->id )
            ->update([
                'address'=>$request->address,
                'birthdate'=>$request->birthdate,
                'gender'=>$request->gender,
                'contact'=>$request->contact]);

            $user = DB::table('unverified_users')
            ->join('users', 'unverified_users.user_id',  '=', 'users.id')
            ->select('unverified_users.*','users.img')
            ->where('unverified_users.user_id', '=',  $user->id )->get();



            return response()->json([
                'success' => true,
                'user' => $user,
                'img' => $img,
            ]);
    }

    public function get_user_info(Request $request){
        $user = User::find(Auth::user()->id);

        if($user->role == "verified_user")
        {
            $user = DB::table('verified_users')
            ->join('users', 'verified_users.user_id',  '=', 'users.id')
            ->select('verified_users.*','users.img','users.role')
            ->where('verified_users.user_id', '=',  $user->id )->get();
        }
        elseif($user->role == "unverified_user"){
        $user = DB::table('unverified_users')
            ->join('users', 'unverified_users.user_id',  '=', 'users.id')
            ->select('unverified_users.*','users.img','users.role')
            ->where('unverified_users.user_id', '=',  $user->id )->get();
        }

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);

    }


    public function change_password(Request $request){

        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ],422);
        }

        if(Hash::check($request->old_password,$user->password)){

            if(Hash::check($request->password, $user->password)){
                return response()->json([
                    'success' => false  ,
                    'message' => 'New Password should not be equal to the old password .',
                ],422);
            }

          elseif($request->password != $request->confirm_password || $request->confirm_password != $request->password){
                return response()->json([
                    'success' => false,
                    'message' => 'Password does not match. Please try again.',
                ],422);
             }

            else{
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Password changed successfully.',
                ],200);
            }

        }

         else{
            return response()->json([
                'success' => false,
                'message' => 'Old Password does not match. Please try again.',
            ],422);
        }



    }


    public function forgot_password(Request $request){


        try{

            $user = User::where('email',$request->email)->get();


            if(count($user) > 0) {

                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain.'/reset-password?token=' . $token;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = "Password Reset";
                $data['body'] = "Please click on the link to reset your password.";

                Mail::send('forgetPasswordMail',['data' => $data],function($message) use($data){

                    $message->to($data['email'])->subject($data['title']);

                });


                $datatime = Carbon::now()->format('Y-m-d H:i:s');

                PasswordReset::updateOrCreate(

                    ['email' => $request->email],

                    [

                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datatime

                    ]
                );

                return response()->json([
                    'success' => true,
                    'message' => "Please check your email to reset your password",
                ]);



            }
            else {

                return response()->json([
                    'success' => false,
                    'message' => "User Not Found.",
                ]);

            }


        } catch(Exception $e){

            return response()->json([
                'success' => false,
                'message' => $e->getMessages(),
            ]);

        }




    }


    public function resetPasswordLoad(Request $request){
        $resetData = PasswordReset::where('token',$request->token)->get();
        //  dd($resetData);

         $data = $resetData[0]['email'];

        //  dd($data);
        if(isset($request->token) && count($resetData) > 0){

            // $user = User::where('email', $resetData->email)->get();


            //  $user = DB::table('users')

            // ->select('email')
            // ->where('email', '=', $data)
            // ->get();

            $user = User::where('email', $resetData[0]['email'])->get();

            //   dd($user);
            return view('resetPassword',compact('user'));

        }
        else {
            return view('404');
        }


    }

    public function resetPassword(Request $request){


        $request->validate([
            'password'=> 'required|min:2|max:200',
        ]);


        $user = User::find($request->id);
        $user->password = Hash::make($request->password);

        $user->save();

        return "<h1> Your password has been reset successfully!</h1>";


    }

    public function update_profile_picture(Request $request){

        $user = User::find(Auth::user()->id);

        $img = '';

        if($request->img!=''){
            $img = 'storage/images/'.time().'.jpg';
            file_put_contents($img,base64_decode($request->img));
            $user->img = $img;
        }

        $user->update();

        return response()->json([
            'success' => true,
            'user' => $user,
            'img' => $img,
        ]);

    }






}
