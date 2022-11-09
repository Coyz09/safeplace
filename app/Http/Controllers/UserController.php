<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Auth;
use Validator;
use App\Models\UnverifiedUser;
use App\Models\VerifiedUser;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Session;
use Hash;
use Cookie;
class UserController extends Controller
{

    public function getUser()
        {

            $users =User::select('*');
            return  Datatables::of($users)
            ->addColumn('action', 'user.action')
            ->make();

        }

    public function index()
        {
            return View::make('user.index');
        }

     public function create()
         {
             return View::make('user.create');
         }

    public function store(Request $request)
    {
        $rules =[
            'name' => 'required|min:2|max:200',          
            'email'=> 'required|min:2|max:200',
            'password'=> 'required|min:2|max:200',
            'role'=> 'required|min:2|max:200',
              ];

        $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!',
            'numeric' => '*Numbers Only',
            'name.required' => '*User Name Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{

        $user = new User([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'password' => bcrypt($request->input('password')),
          'role' => $request->input('role')]);
          $user->save();

        return Redirect::to('user')->with('success','New User added!');
        }
    }


    public function edit($id)
        {
            $user = User::find($id);
             return View::make('user.edit',compact('user'));
         }

         public function update(Request $request, $id)
         {
             $rules =[
                     'name' => 'required|min:2|max:200',          
                     'email'=> 'required|min:2|max:200',
                     'password'=> 'required|min:2|max:200',
                     'role'=> 'required|min:2|max:200',
                       ];
     
             $messages = [
                 'required' => '*Field Empty',
                 'min' => '*Too Short!',
                 'max' => '*Too Long!',
                 'numeric' => '*Numbers Only',
                 'name.required' => '*User Name Required',
               ];
           
              $user = User::find($id);

              $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role'),
              ];

            //   dd($data);
            //   $user->update();
            

            $user->update($data);
     
     
              return Redirect::to('user')->with('success','User updated!');
             
         }
     
        public function destroy($id)
         {
             $user = User::find($id);
             $user->delete();
             
              return Redirect::to('user')->with('success','User deleted!');
         }

    public function getSignup(){
        return view('user.signup');
    }

     public function postSignup(Request $request){
        $this->validate($request, [
            'fname' => 'required| min:4',
            'email' => 'email|required|unique:users',
            'password' => 'required| min:4',
            'gender'=> 'required|min:2|max:20',
            'birthdate'=> 'required',
            'address' => 'required',
            'contact' => 'numeric',             
            'email'=> 'required|min:2|max:20',
            'img' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',     
        ]);

        // $input = $request->all();
        if($request->hasFile('img')){
           $img = $request->file('img')->getClientOriginalName();
           
           $request->file('img')->storeAs('public/images', $img);
           
           $input['img'] = 'storage/images/'.$img;

           $user = new User([
            'name' => $request->input('fname').' '.$request->mname.' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'unverified_user',
            'img' => $input['img'] ,
         ]);
         $user->save();
        }
            // dd($input['img'] );  

         $unverified_user = new UnverifiedUser;
         $unverified_user->user_id = $user->id;
         $unverified_user->fname = $request->input('fname');
         $unverified_user->mname = $request->input('mname');
         $unverified_user->lname = $request->input('lname');
         $unverified_user->address = $request->address;
         $unverified_user->birthdate = $request->birthdate;
         $unverified_user->gender = $request->gender;
         $unverified_user->email = $request->email;
         $unverified_user->contact = $request->contact;
         $unverified_user->status = 'Pending';
         $unverified_user->save();

        //  Auth::login($user);
         return redirect()->route('user.profile')->with('success',"Successfully Signup!");
    }

     public function getSignin(){
        return view('user.signin');
     }


    //  public function getProfile() {
    //     //$orders = Auth::user()->with('orders')->get();
    //     $orders = Auth::user()->orders;
    //     // dd($orders);
    //     $orders->transform(function($order, $key){
    //         $order->cart = unserialize($order->cart);
    //         return $order;
    //     });

    //  $customer = Customer::where('user_id',Auth::id())->first();
    //  $orders = Order::with('customer','items')->where('customer_id',$customer->customer_id)->get();
    //     return view('user.profile',compact('orders'));
    // }


    public function getLogout(Request $request){
      
        // Session::flush();
        // Session::forget();
        // Session::invalidate();
        // Session::regenerateToken();
        Auth::logout();
        // $request->session()->flush();
        // $request->session()->invalidate();

        // $request->session()->regenerateToken(); // add this line here
        // $rememberMeCookie = Auth::getRecallerName();
        // // Tell Laravel to forget this cookie
        // $cookie = Cookie::forget($rememberMeCookie);
        return redirect()->route('user.signin') ->with('success','Successfully Logout');;
    }

}


