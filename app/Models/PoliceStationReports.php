<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceStationReports extends Model
{
    use HasFactory;
    public $table = 'police_station_reports';
    protected $fillable = ['barangay','street','police_substation','complainant_id','complainant_name','complainant_address','complainant_gender','complainant_age','complainant_contact','complainant_email','complainant_identity','report_details','report_images','report_status','date_reported','time_reported','date_commited','time_commited','incident_type'];

    public $timestamps =true;
    public $primaryKey = 'id';
}
