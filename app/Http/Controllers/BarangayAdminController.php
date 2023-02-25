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
use App\Models\Barangay;
use Yajra\Datatables\Datatables;

class BarangayAdminController extends Controller
{
   
    public function getBarangayAccounts()
    {
        $role = "barangay";
        $barangayaccounts = DB::table('users')
        ->select('*')
        ->where('role', '=', $role)
        ->get();

        return  Datatables::of($barangayaccounts)
        ->addColumn('action', 'barangay_admin.action')
        ->make();
        // return response()->json($users);

    }

    public function index()
    {
        return View::make('barangay_admin.index');
    }

  
    public function create()
    {
        $barangays = Barangay::select('*')->get();
        return View::make('barangay_admin.create',compact('barangays'));
    }


    public function store(Request $request)
    {
        // dd($request->input('name'),$request->input('barangay_id') );
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
              'role' => 'barangay',
              'img' => $input['img'] ]);      
           $user->save();
        

         DB::table('barangay_accounts')->insert(
            ['barangay_id' => $request->input('barangay_id') , 
             'user_id' => $user->id,
             'role' => $request->input('role')
             ]
            );
     }
  
          return Redirect::to('barangayadmin')->with('success','New Barangay added!');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
         $barangay= User::find($id);
         return View::make('barangay_admin.edit',compact('barangay'));
     }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:200',          
            'email'=> 'required|min:2|max:200',
            'password'=> 'required|min:2|max:200',   
            'role'=> 'required|min:2|max:200',
            // 'img' => 'required|image|mimes:jpg,png,gif,jpeg,jfif,svg|max:2048',     
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
           else
           {

            $user = User::find($id);
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role'),
              ];

            $user->update($data);
           }
 
          return Redirect::to('barangayadmin')->with('success','Barangay updated!');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
             
        return Redirect::to('barangayadmin')->with('success','Barangay deleted!');
    }
}
