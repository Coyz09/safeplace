<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject

{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'img',
        'qr_code',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    

    public function unverifiedusers()
    {
    	return $this->belongsToMany('App\Models\UnverifiedUser');
    }

    public function users()
    {
    	return $this->belongsToMany('App\Models\VerifiedUser');
    }

    public function barangays()
    {
    	return $this->hasMany('App\Models\Barangay');
    }

    public function policestations()
    {
    	return $this->belongsToMany('App\Models\PoliceStation');
    }
    

    public function isAdmin()
        {
            if($this->role === "admin")
            { 
                return true; 
            } 
            else 
            { 
                return false; 
            }
        }
        
        public function isSuperAdmin()
        {
            if($this->role === "superadmin")
            { 
                return true; 
            } 
            else 
            { 
                return false; 
            }
        }

        public function isUser()
        {
            if($this->role === "unverified_user" || $this->role === "verified_user")
            { 
                return true; 
            } 
            else 
            { 
                return false; 
            }
        }

    
}
