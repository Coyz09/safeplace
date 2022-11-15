<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Validator;
use App\Models\Hospital;
use Yajra\Datatables\Datatables;

class HospitalController extends Controller
{

    public function index()
    {
        return View::make('hospitals.index');
    }

    public function getHospital()
    {

        $hospitals = Hospital::select('*');
        return  Datatables::of($hospitals)
        ->addColumn('action', 'hospitals.action')
        ->make();

    }



    public function create()
    {
        return View::make('hospitals.create');
    }


    public function store(Request $request)
    {
         $rules =[
                'hospital_name' => 'required|min:2|max:100',
                'hospital_type' => 'required',
                'hospital_medical_director' => 'required',
                'address' => 'required',
                'hospital_schedule' => 'required',
                'hospital_contact' => 'numeric',
                  ];

        $messages = [
            'required' => '*Field Empty',
            'min' => '*Too Short!',
            'max' => '*Too Long!',
            'numeric' => '*Numbers Only',
            'hospital.name.required' => '*Hospital Name Required',
            'address.required' => '*Hospital Address Required',
          ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);

      }
      else{
        // Hospital::create($request->all());

        $hospital = new Hospital; 
        $hospital->hospital_name = $request->hospital_name;
        $hospital->hospital_type = $request->hospital_type;
        $hospital->hospital_medical_director = $request-> hospital_medical_director;
        $hospital->hospital_location= $request->input('address');
        $hospital->latitude= $request->input('latitude');
        $hospital->longitude= $request->input('longitude');
        $hospital->hospital_schedule= $request->hospital_schedule;
        $hospital->hospital_contact= $request->hospital_contact;
        $hospital->save();

        return Redirect::to('hospital')->with('success','New Hospital added!');
        }
    }


    public function show($id)
    {
        $hospital = Hospital::find($id);

        return View::make('hospitals.show',compact('hospital'));
    }


    public function edit($id)
    {
        $hospital = Hospital::find($id);
        return View::make('hospitals.edit',compact('hospital'));
    }

    public function update(Request $request, $id)
    {
        $rules =[
            'hospital_name' => 'required|min:2|max:100',
            'hospital_type' => 'required',
            'hospital_medical_director' => 'required',
            'hospital_location' => 'required',
            'hospital_schedule' => 'required',
            'hospital_contact' => 'numeric',
              ];

    $messages = [
        'required' => '*Field Empty',
        'min' => '*Too Short!',
        'max' => '*Too Long!',
        'numeric' => '*Numbers Only',
        'hospital_name.required' => '*Hospital Name Required',
      ];

      $validator = Validator::make($request->all(), $rules,$messages);
      if($validator->fails())
      {
        return redirect()->back()->withInput()->withErrors($validator);

      }
      else{
          $hospital = Hospital::find($id);
          $hospital ->update($request->all());
         return Redirect::to('hospital')->with('success','Hospital updated!');
        }
    }


    public function destroy($id)
    {
         $hospital = Hospital::find($id);
         $hospital->delete();
         return Redirect::to('hospital')->with('success','Hospital deleted!');
    }
}
