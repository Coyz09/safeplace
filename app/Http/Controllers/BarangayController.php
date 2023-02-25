<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\Barangay;
use App\Models\User;
use Yajra\Datatables\Datatables;

class BarangayController extends Controller
{
   
    public function index()
    {
        return View::make('barangays.index');
    }


    public function getBarangay(){
        $barangays = Barangay::select('*');

      return  Datatables::of($barangays)
      ->addColumn('action', 'barangays.action')
      ->make();
    }



      public function create()
    {
       return View::make('barangays.create');
    }

    

    public function store(Request $request)
    {
      $rules =[
        'barangay_name' => 'required|min:2|max:100',
        'barangay_captain' => 'required',
        'address' => 'required',
        'barangay_schedule' => 'required',
        'barangay_contact' => 'numeric',
          ];

      $messages = [
        'required' => '*Field Empty',
        'min' => '*Too Short!',
        'max' => '*Too Long!', 
        'numeric' => '*Numbers Only',
        'barangay_name.required' => '*Barangay Name Required',
        'address.required' => '*Barangay Address Required',
      ];

      $validator = Validator::make($request->all(), $rules,$messages);

      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{
        
        if($request->hasFile('img')){

          $img  = time().'.'.$request->file('img')->extension();  
          $request->file('img')->move(public_path('storage/images'), $img);   
          
          $input['img'] = 'storage/images/'.$img;

          $user = User::create([
            'name' => $request->input('barangay_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'barangay',
            'img' => $input['img'] ,
        ]);
        $user->save();

          $barangay = new Barangay; 
          $barangay->barangay_name = $request->barangay_name;
          $barangay->barangay_captain = $request->barangay_captain;
          $barangay->barangay_location= $request->input('address');
          $barangay->latitude= $request->input('latitude');
          $barangay->longitude= $request->input('longitude');
          $barangay->barangay_schedule= $request->barangay_schedule;
          $barangay->barangay_contact= $request->barangay_contact;
          $barangay->img = $input['img'];
          $barangay->user_id = $user->id;

          $barangay->save();

          DB::table('barangay_accounts')->insert(
            ['barangay_id' => $barangay->id, 
             'user_id' => $user->id,
             'role' => $request->input('role')
             ]
            );
          
      }

        return Redirect::to('barangay')->with('success','New Barangay added!');
        }
      }
    

    public function show($id)
    {
        $barangay = Barangay::find($id);
        
        return View::make('barangays.show',compact('barangay'));
    }

    public function edit($id)
    {
         $barangay = Barangay::find($id);
  
         $emails = DB::table('users')
          ->join('barangays', 'users.id', '=', 'barangays.user_id')
          ->select('users.id','users.email')
          ->where('barangays.id','=', $id)
          ->pluck('users.email','users.id');

          $passwords = DB::table('users')
          ->join('barangays', 'users.id', '=', 'barangays.user_id')
          ->select('users.id','users.password')
          ->where('barangays.id','=', $id)
          ->pluck('users.password','users.id');
          // dd($user);
          // $users = User::pluck('email','id');
         return View::make('barangays.edit',compact('barangay','emails','passwords'));
    }

    public function update(Request $request, $id)
    {
          $rules =[
            'barangay_name' => 'required|min:2|max:100',
            'barangay_captain' => 'required',
            'address' => 'required',
            'barangay_schedule' => 'required',
            'barangay_contact' => 'numeric',
              ];
    
          $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!', 
            'numeric' => '*Numbers Only',
            'barangay_name.required' => '*Barangay Name Required',
            'address.required' => '*Barangay Address Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);
         
      }
      else{

        if($request->hasFile('img')){

          $img  = time().'.'.$request->file('img')->extension();  
          $request->file('img')->move(public_path('storage/images'), $img);   
          
          $input['img'] = 'storage/images/'.$img;

          $barangay = Barangay::find($id);  
            $data = [
              "barangay_name" => $request->barangay_name,
              "barangay_captain" => $request->input('barangay_captain'),
              "barangay_location" => $request->input('address'),
              "latitude"=> $request->input('latitude'),
              "longitude"=>$request->input('longitude'),
              "barangay_schedule"=> $request->barangay_schedule,
              "barangay_contact"=> $request->barangay_contact,
              "img" => $input['img'],
              "user_id" => $request->user_id,
            ];

            $barangay->update($data);
         
          // $barangay ->update($request->all());


          $users= DB::table('users')
          ->join('barangays', 'users.id', '=', 'barangays.user_id')
          ->select('barangays.user_id','barangays.img')
          ->where('barangays.id','=', $id)
          // ->get();
          ->update(['users.name'=>$request->barangay_name,'email'=>$request->email,'password'=>bcrypt($request->input('password')),'users.img'=>$input['img']]);  
// dd($users);
         return Redirect::to('barangay')->with('success','Barangay updated!');
        }
    }
  }
    public function destroy($id)
    {
         $barangay = Barangay::find($id);

         $users= DB::table('users')
          ->join('barangays', 'users.id', '=', 'barangays.user_id')
          ->select('barangays.user_id')
          ->where('barangays.id','=', $id)
          ->delete();
          
         $barangay->delete();
         return Redirect::to('barangay')->with('success','Barangay deleted!');
    }
}
