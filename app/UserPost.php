<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserPost extends Model
{
	protected $fillable = ['type', 'title', 'desc', 'user_id'];

    public function user(){
    	return $this->belongsTo(\App\User::class);
    }
    public static function getPost($id){
    	return DB::table('user_posts')
    		->select('title', 'desc', 'name', 'avatar', 'role')
    		->join('users', 'user_id', '=', 'users.id')
    		->where('user_posts.id', $id)
    		->first();
    }
    public static function allPost($check){
    	$db = DB::table('user_posts')
    		->select('user_posts.id as toId', 'title', 'name')
    		->join('users', 'user_id', '=', 'users.id')
    		->orderBy('user_posts.id', 'desc');

    	if($check == 'with-bk') return $db->get();
    	else return $db->where('type', 0)->get();
    }
    public static function getUserPost($id){
    	return DB::table('user_posts')
    		->select('id', 'title')
    		->where('user_id', $id)
    		->get();
    }
    public static function search($q, $role){
    	$db = DB::table('user_posts')
    		->select('user_posts.id as toId', 'title', 'name')
    		->join('users', 'user_id', '=', 'users.id')
    		->where('title', 'like', '%'.$q.'%');

    	if($role === 1) return $db->get();
    	else return $db->where('type', 0)->get();
    }
}
