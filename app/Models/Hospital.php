<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
   use HasFactory;
   public $table = 'hospitals';
   protected $fillable = ['hospital_name','hospital_type','hospital_medical_director','hospital_location','latitude',
   'longitude','hospital_schedule','hospital_contact'];
   public $timestamps =true;
   public $primaryKey = 'id';
}
