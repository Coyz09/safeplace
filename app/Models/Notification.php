<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

   use HasFactory;
   public $table = 'notifications';
   protected $fillable = ['message','status','user_id'];
   public $timestamps =true;
   public $primaryKey = 'id';



}
