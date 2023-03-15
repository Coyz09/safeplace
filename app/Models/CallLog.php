<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{

    use HasFactory;

    public $table = 'call_logs';
    protected $fillable = ['user_name','name_contacted','type_contacted','date_contacted','time_contacted','user_id'];
    public $timestamps =true;
    public $primaryKey = 'id';

}
