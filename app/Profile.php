<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profile extends Model
{
	protected $fillable = ['phone', 'gender', 'cls', 'school', 'born', 'user_id'];
    
    public function user(){
    	return $this->belongsTo(\App\User::class);
    }
    public static function getData($id){
    	return DB::table('profiles')
    		->join('users', 'user_id', '=', 'users.id')
    		->where('user_id', $id)
    		->first();
    }
    public static function checkUser($id){
        return DB::table('profiles')
            ->select('school')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('user_id', $id)
            ->first();
    }
}
