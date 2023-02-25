<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangayReports extends Model
{
    use HasFactory;
    public $table = 'barangay_reports';
    protected $fillable = ['report_title','report_details','report_status', 'manage_by'];
    public $timestamps =true;
    public $primaryKey = 'id';
}
