<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;


use Illuminate\Support\Facades\Storage;
use File;
use Response;
use DB;

class FrontpageController extends Controller
{

    public function downloadapk()
    {
        $filepath = public_path('apk/safeplace.apk');
        return Response::download($filepath); 
    }

    public function index()
    {
        return View::make('frontpage.homepage');
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
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
