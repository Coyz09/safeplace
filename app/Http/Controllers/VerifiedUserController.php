<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\UnverifiedUser;
use App\Models\VerifiedUser;
use App\Models\User;
use Yajra\Datatables\Datatables;

class VerifiedUserController extends Controller
{

    public function getVerifiedUser()
    {

        $verifiedusers = VerifiedUser::select('*');
        return  Datatables::of($verifiedusers)
        ->addColumn('action', 'verifiedusers.action')
        ->make();

    }


    public function index()
    {
        return View::make('verifiedusers.index');
    }

   
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $verifieduser = VerifiedUser::find($id);

        $passwords = DB::table('users')
        ->join('verified_users', 'users.id', '=', 'verified_users.user_id')
        ->select('users.id','users.password')
        ->pluck('users.password','users.id');

        return View::make('verifiedusers.edit',compact('verifieduser','passwords'));
    }

  
    public function update(Request $request, $id)
    {
        $rules =[
                'fname' => 'required|min:2|max:200',
                'mname' => 'required|min:2|max:200',
                'lname' => 'required|min:2|max:200',
                'gender'=> 'required|min:2|max:200',
                'birthdate'=> 'required',
                'address' => 'required',
                'contact' => 'numeric',             
                'email'=> 'required|min:2|max:20',
                'user_id'=> 'required|min:2|max:20',
                  ];

        $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!',
            'numeric' => '*Numbers Only',
            'fname.required' => '*VerifiedUser First Name Required',
            'mname.required' => '*VerifiedUser Middle Name Required',
            'lname.required' => '*VerifiedUser Last Name Required',
          ];

         //  dd($request->all());
      
         $verifieduser = VerifiedUser::find($id);
         $verifieduser ->update($request->all());

         
         $users= DB::table('users')
         ->join('verified_users', 'users.id', '=', 'verified_users.user_id')
         ->select('verified_users.user_id')
         ->where('verified_users.id', '=', $id)
         ->update(['users.email'=>$request->input('email'),'users.password'=>bcrypt($request->input('password'))]); 

         return Redirect::to('verifieduser')->with('success','Verified User updated!');
        
    }

   
    public function destroy($id)
    {
        $deleteuser = DB::table('users')
            ->join('verified_users', 'users.id', '=', 'verified_users.user_id')
            ->select('verified_users.user_id')
            ->where('verified_users.id', '=', $id)
            ->delete();  
        // dd($deleteuser);

        $verifieduser = VerifiedUser::find($id);
        $verifieduser->delete();

        
         return Redirect::to('verifieduser')->with('success','Verified User deleted!');
    }
}
