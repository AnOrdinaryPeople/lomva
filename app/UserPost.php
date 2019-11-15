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
    		->select('user_posts.id as toId', 'title', 'name', 'role', 'type', 'user_posts.created_at as date_post', 'desc', DB::raw('count(reply) as total'))
    		->join('users', 'user_id', '=', 'users.id')
            ->leftJoin('comments', 'post_id', '=', 'user_posts.id')
            ->groupBy('user_posts.id')
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
    		->select('user_posts.id as toId', 'title', 'name', 'role', 'type', 'user_posts.created_at as date_post', 'desc', DB::raw('count(reply) as total'))
    		->join('users', 'user_id', '=', 'users.id')

            ->leftJoin('comments', 'post_id', '=', 'user_posts.id')
            ->groupBy('user_posts.id')
    		->where('title', 'like', '%'.$q.'%');

    	if($role === 1) return $db->orderBy('user_posts.id', 'desc')->paginate(10);
    	else return $db->where('type', 0)->orderBy('user_posts.id', 'desc')->paginate(10);
    }
    public static function getThisPost($id, $userId){
        return DB::table('user_posts')
            ->where('user_id', $userId)
            ->where('id', $id)
            ->first();
    }
    public static function getAll(){
        return DB::table('user_posts')
            ->select('user_posts.id as i', 'name', 'type', 'title', 'desc')
            ->join('users', 'users.id', '=', 'user_id')
            ->orderBy('user_posts.id', 'desc')
            ->paginate(10);
    }
    public static function searchPost($q){
        return DB::table('user_posts')
            ->select('user_posts.id as i', 'name', 'type', 'title', 'desc')
            ->join('users', 'users.id', '=', 'user_id')
            ->where('title', 'like', '%'.$q.'%')
            ->orWhere('name', 'like', '%'.$q.'%')
            ->orderBy('user_posts.id', 'desc')
            ->paginate(10);
    }
}
