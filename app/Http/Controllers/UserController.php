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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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

        $this->validate($request, [
          'name' => 'required|min:2|max:200',
          'email'=> 'required|min:2|max:200',
          'password'=> 'required|min:2|max:200',
          'role'=> 'required|min:2|max:200',
          'img' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',
      ]);


        if($request->hasFile('img')){

          $img  = time().'.'.$request->file('img')->extension();
          $request->file('img')->move(public_path('storage/images'), $img);

          $input['img'] = 'storage/images/'.$img;

          $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
            'img' => $input['img'] ]);
         $user->save();
       }

        return Redirect::to('user')->with('success','New User added!');
        // }
    }


    public function edit($id)
        {
            $user = User::find($id);
             return View::make('user.edit',compact('user'));
         }

         public function update(Request $request, $id)
         {

               $this->validate($request, [
                'name' => 'required|min:2|max:200',
                'email'=> 'required|min:2|max:200',
                'password'=> 'required|min:2|max:200',
                'role'=> 'required|min:2|max:200',
                'img' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',
            ]);


                if($request->hasFile('img')){
                  $img  = time().'.'.$request->file('img')->extension();
                  $request->file('img')->move(public_path('storage/images'), $img);

                  $input['img'] = 'storage/images/'.$img;

                  $user = User::find($id);

                  $data = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'role' => $request->input('role'),
                    'img' => $input['img'],
                  ];



                $user->update($data);
               }

              return Redirect::to('user')->with('success','User updated!');

         }

        public function destroy($id)
         {
             $user = User::find($id);
          // dd($user);
             if ($user->role == "unverified_user"){

                $delete_unverified_user = DB::table('unverified_users')
                ->select('user_id')
                ->where('user_id', '=', $id)
                 ->delete();
             }

             elseif ($user->role == "verified_user"){
                $delete_verified_user = DB::table('verified_users')
                ->select('user_id')
                ->where('user_id', '=', $id)
                  ->delete();
                // ->get();

                //  dd ($delete_verified_user);
            }

             elseif ($user->role == "barangay"){
                $delete_barangay = DB::table('barangays')
                ->select('user_id')
                ->where('user_id', '=', $id)
                  ->delete();
                // ->get();

                //  dd ($delete_barangay );
             }

             elseif ($user->role == "police_station"){
                $delete_police_station = DB::table('police_stations')
                ->select('user_id')
                ->where('user_id', '=', $id)
                  ->delete();
                // ->get();

                //  dd ($delete_police_station );
            }

             $user->delete();

              return Redirect::to('user')->with('success','User deleted!');
         }

    public function getSignup(){
        return view('user.signup');
    }

     public function postSignup(Request $request){
        $this->validate($request, [
            'fname' => 'required| min:4',
            'mname' => 'required| min:4',
            'lname' => 'required| min:4',
            'email'=> 'email|required|unique:users|min:2|max:200',
            'password' => 'required| min:4',
            'gender'=> 'required|min:2|max:20',
            'birthdate'=> 'required',
            'address' => 'required',
            'contact' => 'required|numeric',
            'img' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',
        ]);

        if($request->hasFile('img')){

           $img  = time().'.'.$request->file('img')->extension();
           $request->file('img')->move(public_path('storage/images'), $img);

           $input['img'] = 'storage/images/'.$img;

           $user = User::create([
            'name' => $request->input('fname').' '.$request->mname.' '.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'unverified_user',
            'img' => $input['img'] ,
         ]);
         $user->save();
        }

         Auth::guard('web')->login($user);

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
         $unverified_user->status = 'Unverified';
         $unverified_user->save();

         return redirect()->route('user.profile')->with('success',"Successfully Signup!");
    }

     public function getSignin(){
        return view('user.signin');
     }


     public function getProfile() {
      $user = User::find(auth()->guard('web')->user()->id);


      if (($user->role == "unverified_user"))
        {
            $users = DB::table('unverified_users')
            ->select('*')
            ->where('user_id',$user->id)
            ->first();

        }

      elseif (($user->role == "verified_user"))
          {
            $users = DB::table('verified_users')
            ->select('*')
            ->where('user_id',$user->id)
            ->first();
        }

        // $qrcode = QrCode::size(200)->merge(('\public\Images\Logo.png'))->generate($user->qr_code);
        $qrcode = QrCode::size(200)->generate($user->qr_code);
        // dd($qrcode);

        return view('user.profile',compact('users','user','qrcode' ));
    }


    public function EditProfile(User $user) {
      $user = User::find(auth()->guard('web')->user()->id);

      if (($user->role == "unverified_user"))
        {
            $users = DB::table('unverified_users')
            ->select('*')
            ->where('user_id',$user->id)
            ->first();

        }

      elseif (($user->role == "verified_user"))
          {
            $users = DB::table('verified_users')
            ->select('*')
            ->where('user_id',$user->id)
            ->first();
        }

        return View::make('user.updateprofile',compact('user','users'));

    }

    public function UpdateProfile(Request $request, $user) {

               $this->validate($request, [
                'name' => 'required|min:2|max:200',
                'email'=> 'required|min:2|max:200',
                'password'=> 'required|min:2|max:200',
                'img' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',
            ]);


                if($request->hasFile('img')){
                  $img  = time().'.'.$request->file('img')->extension();
                  $request->file('img')->move(public_path('storage/images'), $img);

                  $input['img'] = 'storage/images/'.$img;

                  $id = User::find(auth()->guard('web')->user()->id);
                  // dd($id);
                  $user = User::find($id->id);


                  $data = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'role' => $id->role,
                    'img' => $input['img'],
                  ];



                $user->update($data);
               }

              return Redirect::to('profile')->with('success','User updated!');


    }


    public function getLogout(Request $request){
        Auth::logout();
        return redirect()->route('user.signin') ->with('success','Successfully Logout');;
    }

}


