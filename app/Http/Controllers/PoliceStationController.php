<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\PoliceStation;
use App\Models\User;
use Yajra\Datatables\Datatables;

class PoliceStationController extends Controller
{
  
    public function index()
    {
        return View::make('policestations.index');
    }

    public function getPoliceStation(){
        $policestations = PoliceStation::select('*');

      return  Datatables::of($policestations)
      ->addColumn('action', 'policestations.action')
      ->make();
    }
    public function create()
    {
       return View::make('policestations.create');
    }


    public function store(Request $request)
    {
         $rules =[
          'policestation_name' => 'required|min:2|max:100',
          'policestation_commander' => 'required',
          'address' => 'required',
          'policestation_schedule' => 'required',
          'policestation_contact' => 'numeric',
                  ];

        $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!', 
            'numeric' => '*Numbers Only',
            'policestation_name.required' => '*Police Station Name Required',
            'address.required' => '*Police Station Address Required',
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

          $user = new User([
            'name' => $request->input('policestation_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'police_station',
            'img' => $input['img'] ,
          ]);
          $user->save();

          $policestation = new PoliceStation; 
          $policestation->policestation_name = $request->policestation_name;
          $policestation->policestation_commander= $request->policestation_commander;
          $policestation->policestation_location= $request->input('address');
          $policestation->latitude= $request->input('latitude');
          $policestation->longitude= $request->input('longitude');
          $policestation->policestation_schedule= $request->policestation_schedule;
          $policestation->policestation_contact= $request->policestation_contact;
          $policestation->img = $input['img'];
          $policestation->user_id = $user->id;
          $policestation->save();
        }
        return Redirect::to('policestation')->with('success','New Police Station added!');
      }
    }


    public function show($id)
    {
         $policestation = PoliceStation::find($id);   

        return View::make('policestations.show',compact('policestation'));
    }


    public function edit($id)
    {
         $policestation = PoliceStation::find($id);   

         $emails = DB::table('users')
          ->join('police_stations', 'users.id', '=', 'police_stations.user_id')
          ->select('users.id','users.email')
          ->where('police_stations.id','=', $id)
          ->pluck('users.email','users.id');

          $passwords = DB::table('users')
          ->join('police_stations', 'users.id', '=', 'police_stations.user_id')
          ->select('users.id','users.password')
          ->where('police_stations.id','=', $id)
          ->pluck('users.password','users.id');

        return View::make('policestations.edit',compact('policestation','emails','passwords'));
    }

    public function update(Request $request, $id)
    {
        $rules =[
        'policestation_name' => 'required|min:2|max:100',
        'policestation_commander' => 'required',
        'address' => 'required',
        'policestation_schedule' => 'required',
        'policestation_contact' => 'numeric',
                ];

        $messages = [
          'required' => '*Field Empty',
          'min' => '*Too Short!',
          'max' => '*Too Long!', 
          'numeric' => '*Numbers Only',
          'policestation_name.required' => '*Police Station Name Required',
          'address.required' => '*Police Station Address Required',
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

          $policestation = PoliceStation::find($id);           

          $data = [
            "policestation_name" => $request->policestation_name,
            "policestation_commander" => $request->input('policestation_commander'),
            "policestation_location" => $request->input('address'),
            "latitude"=> $request->input('latitude'),
            "longitude"=>$request->input('longitude'),
            "policestation_schedule"=> $request->policestation_schedule,
            "policestation_contact"=> $request->policestation_contact,
            "img" => $input['img'],
            "user_id" => $request->user_id,
          ];

          $policestation->update($data);

          $users= DB::table('users')
          ->join('police_stations', 'users.id', '=', 'police_stations.user_id')
          ->select('police_stations.user_id','police_stations.img')
          ->where('police_stations.id','=', $id)
          ->update(['users.name'=>$request->policestation_name,'email'=>$request->email,'password'=>bcrypt($request->input('password')),'users.img'=>$input['img']]);  


        }

         return Redirect::to('policestation')->with('success','Police Station updated!');
        }
    }


    public function destroy($id)
    {
         $policestation = PoliceStation::find($id);
         
         $users= DB::table('users')
         ->join('police_stations', 'users.id', '=', 'police_stations.user_id')
         ->select('police_stations.user_id')
         ->where('police_stations.id','=', $id)
         ->delete();

         $policestation->delete();

         return Redirect::to('policestation')->with('success','Police Station deleted!');
    }
}
