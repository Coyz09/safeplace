<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceStationReports extends Model
{
    use HasFactory;
    public $table = 'police_station_reports';
    protected $fillable = ['report_title','report_details','report_status'];
    public $timestamps =true;
    public $primaryKey = 'id';
}
