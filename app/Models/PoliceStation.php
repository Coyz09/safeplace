<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceStation extends Model
{
    use HasFactory;
    public $table = 'police_stations';
   protected $fillable = ['policestation_name','policestation_commander','policestation_location','latitude',
   'longitude','policestation_schedule','policestation_contact','user_id'];
   public $timestamps =true;
   public $primaryKey = 'id';

   public function users()
   {
       return $this->belongsToMany('App\Models\User');
   }
   
}
