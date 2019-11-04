<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chat extends Model
{
    protected $fillable = ['msg', 'user_id', 'chat_with'];

    public function user(){
    	return $this->belongsToMany(\App\User::class);
    }

    public static function getChat($id, $userId){
    	return [
    		'sender' => DB::table('chats')
	    		->where('user_id', $userId)
	    		->where('chat_with', $id)
	    		->get(),
	    	'receive' => DB::table('chats')
	    		->where('user_id', $id)
	    		->where('chat_with', $userId)
	    		->get()
    	];
    }
    public static function getReceiver($id, $role){
        return DB::table('chats')
            ->select('users.id as id', 'name', 'avatar', 'school', DB::raw('count(`read`) as total'))
            ->join('users', 'users.id', '=', 'chats.user_id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('role', '!=', $role)
            ->where('read', 0)
            ->groupBy('chats.user_id')
            ->get();
    }
}
