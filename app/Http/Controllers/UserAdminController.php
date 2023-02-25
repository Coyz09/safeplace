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


class UserAdminController extends Controller
{
    public function getUserAccounts()
    {
        $verified_user = "verified_user";
        $unverified_user = "unverified_user";

        $useraccounts = DB::table('users')
        ->select('*')
        ->where('role', '=', $unverified_user)
        ->orWhere('role', '=', $verified_user)
        ->get();

        return  Datatables::of($useraccounts)
        ->addColumn('action', 'user_admin.action')
        ->make();

        // return response()->json($useraccounts);
    }

    public function index()
    {
        return View::make('user_admin.index');
    }

   
    public function create()
    {
        return View::make('user_admin.create');
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

        return Redirect::to('useradmin')->with('success','New User added!');
        // }
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $user = User::find($id);
         return View::make('user_admin.edit',compact('user'));
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
 
          return Redirect::to('useradmin')->with('success','User updated!');
   
     }

    
     public function destroy($id)
     {
         $user = User::find($id);

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
        }

         $user->delete();
         
          return Redirect::to('user')->with('success','User deleted!');
     }
}
