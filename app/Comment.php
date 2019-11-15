<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    protected $fillable = ['reply', 'post_id', 'user_id'];

    public function post(){
    	return $this->belongsTo(\App\UserPost::class);
    }
    public function user(){
    	return $this->belongsToMany(\App\User::class);
    }
    public static function getReply($id){
    	return DB::table('comments')
    		->select('reply', 'name', 'avatar', 'role', 'comments.created_at as date_reply', 'comments.user_id as id_user', 'comments.id as reply_id')
    		->join('user_posts', 'user_posts.id', '=', 'post_id')
    		->join('users', 'users.id', '=', 'comments.user_id')
    		->where('post_id', $id)
    		->orderBy('comments.id', 'desc')
    		->paginate(10);
    }
}
