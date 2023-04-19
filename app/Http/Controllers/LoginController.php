<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Auth;
use DB;

class LoginController extends Controller
{


     public function postSignin(Request $request){

        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);

        $credentials = $request->only('email', 'password');
        $token = auth()->guard('web')->attempt($credentials);

        if($token) {

		//  if(auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {

		    if (auth()->guard('web')->user()->role == 'admin') {
		        return redirect()->route('admin_dashboard');
            }

            // elseif(auth()->guard('web')->user()->role == 'barangay_admin') {
            //     return redirect()->route('barangay.index');
            // }
            
            // elseif(auth()->guard('web')->user()->role == 'policestation_admin') {
            //     return redirect()->route('policestation.index');
            // }

            // elseif(auth()->guard('web')->user()->role == 'user_admin') {
            //     return redirect()->route('useradmin.index');
            // }

            // elseif(auth()->guard('web')->user()->role == 'hospital_admin') {
            //     return redirect()->route('hospital.index');
            // }
        
            elseif(auth()->guard('web')->user()->role == 'barangay') {
                return redirect()->route('barangaydashboard');
            }

            elseif(auth()->guard('web')->user()->role == 'police_station') {
                return redirect()->route('policedashboard');

            }

            elseif(auth()->guard('web')->user()->role == 'superadmin') {
                return redirect()->route('admin_dashboard');
            }       

            elseif(auth()->guard('web')->user()->role == 'unverified_user' || auth()->guard('web')->user()->role == 'verified_user')  {
                $randomString = Str::random(20);

              
                $id = auth()->guard('web')->user()->id;
                // dd($id);

                $users= DB::table('users')
                ->select('qr_code')
                ->where('users.id', '=', $id)
                ->update(['qr_code'=>$randomString]); 

                return redirect()->route('user.profile');
            }
        }

        else{
            return redirect()->route('user.signin')
                ->with('error','Email-Address or Password Are Wrong. Please enter proper Login Credentials!');
        }
    //  }
    }

    //   public function getLogout(){
    //     Auth::logout();
    //     return redirect()->guest('/');
    // }
}
