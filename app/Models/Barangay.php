<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
   use HasFactory;
   public $table = 'barangays';
   protected $fillable = ['barangay_name','barangay_captain','barangay_location','latitude',
   'longitude','barangay_schedule','barangay_contact','user_id'];
   public $timestamps =true;
   public $primaryKey = 'id';
   

   public function users()
   {
      return $this->belongsToMany('App\Models\User');
   }
}
