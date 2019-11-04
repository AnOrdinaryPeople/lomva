<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'provider_id', 'avatar', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function profile(){
        return $this->hasOne(\App\Profile::class);
    }
    public function userPost(){
        return $this->hasMany(\App\UserPost::class);
    }
    public function comment(){
        return $this->hasMany(\App\Comment::class);
    }
    public function chat(){
        return $this->hasMany(\App\Chat::class);
    }

    public static function getReceiver($role){
        return DB::table('users')
            ->select('users.id as id', 'name', 'avatar', 'school')
            ->join('profiles', 'user_id', '=', 'users.id')
            ->where('role', '!=', $role)
            ->where('school', '!=', null)
            ->get();
    }
}
