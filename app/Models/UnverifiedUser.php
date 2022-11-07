<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnverifiedUser extends Model
{
    use HasFactory;
   public $table = 'unverified_users';
   protected $fillable = ['fname','mname','lname','gender','birthdate','address','contact','email','status','user_id'];
   public $timestamps =true;
   public $primaryKey = 'id';

   public function users()
    {
    	return $this->belongsToMany('App\Models\User');
    }
}
