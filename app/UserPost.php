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
    public function comment(){
    	return $this->hasMany(\App\Comment::class);
    }
    public static function getPost($id){
    	return DB::table('user_posts')
    		->select('title', 'desc', 'name', 'avatar', 'role', 'user_posts.created_at as date_post')
    		->join('users', 'user_id', '=', 'users.id')
    		->where('user_posts.id', $id)
    		->first();
    }
    public static function allPost($check){
    	$db = DB::table('user_posts')
    		->select('user_posts.id as toId', 'title', 'name', 'user_posts.created_at as date_post')
    		->join('users', 'user_id', '=', 'users.id')
    		->orderBy('user_posts.id', 'desc');

    	if($check == 'with-bk') return $db->paginate(10);
    	else return $db->where('type', 0)->paginate(10);
    }
    public static function getUserPost($id){
    	return DB::table('user_posts')
    		->select('id', 'title')
    		->where('user_id', $id)
            ->orderBy('id', 'desc')
    		->paginate(10);
    }
    public static function search($q, $role){
    	$db = DB::table('user_posts')
    		->select('user_posts.id as toId', 'title', 'name', 'user_posts.created_at as date_post')
    		->join('users', 'user_id', '=', 'users.id')
    		->where('title', 'like', '%'.$q.'%');

    	if($role === 1) return $db->paginate(10);
    	else return $db->where('type', 0)->paginate(10);
    }
    public static function getThisPost($id, $userId){
        return DB::table('user_posts')
            ->where('user_id', $userId)
            ->where('id', $id)
            ->first();
    }
}
