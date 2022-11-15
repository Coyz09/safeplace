<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnverifiedUser;
use App\Models\User;

use DB;
use Auth;
use Hash;
use JWTAuth;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $token = auth()->guard('api')->attempt($credentials);

        if ($token) {

            if (auth()->guard('api')->user()->role == 'admin') {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                ]);
            }

            if (auth()->guard('api')->user()->role == 'barangay') {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                ]);
            }

            if (auth()->guard('api')->user()->role == 'police') {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                ]);
            }

            else{
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => auth()->guard('api')->user()
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

    

    public function register(Request $request) {

        $encryptedPass = Hash::make($request->password);

        $user = new User;
        $unverified_user = new UnverifiedUser;


        try{
            $user = User::create([
                // 'name' => $request->fname.' '.$request->mname.' '.$request->lname,
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


            $unverified_user->status = 'Pending';
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
        } catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => ''.$e
            ]);
        }
    }

    public function save_user_info(Request $request){

        // $unverified_user = new UnverifiedUser;
        $user = User::find(Auth::user()->id);
    
        $unverified_user = DB::table('unverified_users')
        ->join('users', 'unverified_users.user_id',  '=', 'users.id')
        ->select('unverified_users.user_id')
        ->where('unverified_users.user_id', '=',  $user->id )
        ->update(['address'=>$request->address,'birthdate'=>$request->birthdate,'gender'=>$request->gender,'contact'=>$request->contact]);
    
        return response()->json([
            'success' => true,
            // 'photo' => $photo
            "info" => $unverified_user
        ]);
    
    }

}



