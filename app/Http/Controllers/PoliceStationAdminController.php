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


class PoliceStationAdminController extends Controller
{
    public function getPoliceStationAccounts()
    {
        $role = "police_station";
        $policestationaccounts = DB::table('users')
        ->select('*')
        ->where('role', '=', $role)
        ->get();

        return  Datatables::of($policestationaccounts)
        ->addColumn('action', 'policestation_admin.action')
        ->make();
    }

    public function index()
    {
        return View::make('policestation_admin.index');
    }


    public function create()
    {
        return View::make('policestation_admin.create');
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
              'role' => 'police_station',
              'img' => $input['img'] ]);      
           $user->save();
         }
  
          return Redirect::to('policestationadmin')->with('success','New Police Station added!');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
         $policestation= User::find($id);
         return View::make('policestation_admin.edit',compact('policestation'));
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
                'role' => 'police_station',
                'img' => $input['img'],
              ];

   

            $user->update($data);
           }
 
          return Redirect::to('policestationadmin')->with('success','Police Station updated!');
    }

  
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
             
        return Redirect::to('policestationadmin')->with('success','Police Station deleted!');
    }
}
