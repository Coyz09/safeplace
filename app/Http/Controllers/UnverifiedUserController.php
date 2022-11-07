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

class UnverifiedUserController extends Controller
{
   
    public function index()
    {
        return View::make('unverifiedusers.index');
    }
    
    public function getUnverifiedUser()
    {

        $unverifiedusers = UnverifiedUser::select('*');
        return  Datatables::of($unverifiedusers)
        ->addColumn('action', 'unverifiedusers.action')
        ->make();

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
        $unverifieduser = UnverifiedUser::find($id);
        return View::make('unverifiedusers.edit',compact('unverifieduser'));
    }

  
    public function update(Request $request, $id)
    {
        $rules =[
                'fname' => 'required|min:2|max:200',
                'mname' => 'required|min:2|max:200',
                'lname' => 'required|min:2|max:200',
                'gender'=> 'required|min:2|max:20',
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
         
         
         VerifiedUser::create($request->all());


         $user = DB::table('users')
            ->join('unverified_users', 'users.id', '=', 'unverified_users.user_id')
            ->select('unverified_users.user_id')
            ->where('unverified_users.id', '=', $id)
            ->update(['role'=>'verified_user']);   
            // dd($user);

         $unverifieduser = UnverifiedUser::find($id);
         $unverifieduser->delete();

         return Redirect::to('unverifieduser')->with('success','Unverified User updated!');
        
    }

    public function reject(Request $request, $id)
    {
       
         $unverifieduser = UnverifiedUser::find($id);
         $unverifieduser->update(['status'=>'Rejected']);

         return Redirect::to('unverifieduser')->with('success','Unverified User updated!');
        
    }

    public function destroy($id)
    {

        $deleteuser = DB::table('users')
            ->join('unverified_users', 'users.id', '=', 'unverified_users.user_id')
            ->select('unverified_users.user_id')
            ->where('unverified_users.id', '=', $id)
            ->delete();    
            

            // dd($deleteuser);
        $unverifieduser = UnverifiedUser::find($id);
        $unverifieduser->delete();
        
         return Redirect::to('unverifieduser')->with('success','Unverified User deleted!');
    }

}
