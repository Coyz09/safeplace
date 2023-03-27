<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayReports extends Model
{
    use HasFactory;
    public $table = 'barangay_reports';
    protected $fillable = [
        'barangay',
        'police_substation',
        'street',
        'complainant_id',
        'complainant_name',
        'complainant_address',
        'complainant_gender',
        'complainant_age',
        'complainant_contact',
        'complainant_email',
        'complainant_identity',
        'report_details',

        'report_images_1',
        'report_images_2',
        'report_images_3',

        'report_status',
        'date_reported',
        'time_reported',
        'year_reported',
        'date_commited',
        'time_commited',
        'incident_type'];

    public $timestamps =true;
    public $primaryKey = 'id';
}
