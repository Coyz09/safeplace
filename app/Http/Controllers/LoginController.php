<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
		        return redirect()->route('verifieduser.index');
            }
        
            elseif(auth()->guard('web')->user()->role == 'barangay') {
                return redirect()->route('barangay_user.index');
            }

            elseif(auth()->guard('web')->user()->role == 'police_station') {
                return redirect()->route('policestation_user.index');
            }

            elseif(auth()->guard('web')->user()->role == 'superadmin') {
                return redirect()->route('user.index');
            }

            else {
                return redirect()->route('user.profile');
            }
        }

        else{
            return redirect()->route('user.signin')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    //  }
    }

    //   public function getLogout(){
    //     Auth::logout();
    //     return redirect()->guest('/');
    // }
}
