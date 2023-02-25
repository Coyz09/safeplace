<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Barangay;
use App\Models\PoliceStation;
use App\Models\VerifiedUser;
use App\Models\UnverifiedUser;

class DashboardController extends Controller
{
    public function getCountandLocation()
    {
        $hospitals = Hospital::all();
        $mapHospitals = $hospitals->makeHidden([ 'created_at', 'updated_at']);
        $barangays = Barangay::all();
        $mapBarangays = $barangays->makeHidden(['created_at', 'updated_at']);
        $police = PoliceStation::all();
        $mapPolice = $police->makeHidden(['created_at', 'updated_at']);

        $unverifiedcount = UnverifiedUser::count();
        $verifiedcount = VerifiedUser::count();
        $barangaycount = Barangay::count();
        $hospitalcount = Hospital::count();
        $policecount = PoliceStation::count();

        $latitude = $hospitals->count() ? $hospitals->average('latitude') : 14.529602547244957 ;
        $longitude = $hospitals->count() ? $hospitals->average('longitude') : 121.06994858539447 ;
        // dd($latitude);

        return view('dashboard.admin_dashboard', compact('police', 'mapPolice','barangays','mapBarangays','hospitals', 'mapHospitals', 'latitude', 'longitude','unverifiedcount','verifiedcount','barangaycount','hospitalcount','policecount'));
    }

    public function showHospital(Hospital $hospitals)
    {
        $hospitals->load([]);
        // $hospitals = Hospital::all()->first();
        // dd($hospital);
        return view('dashboard.hospital_info', compact('hospitals'));
    }

    public function showBarangay(Barangay $barangays)
    {
        $barangays->load([]);
    
        return view('dashboard.barangay_info', compact('barangays'));
    }

    public function showPolice(PoliceStation $polices)
    {
        $polices->load([]);
    
        return view('dashboard.policestation_info', compact('polices'));
    }
}
