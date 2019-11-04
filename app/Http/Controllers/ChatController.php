<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getAll($id, $role){
    	return response()->json(User::getReceiver($role));
    }
    public function getChat($id, $userId){
    	return response()->json(Chat::getChat($id, $userId));
    }
    public function sendChat($userId, $chatWith, Request $req){
    	if($req->msg == '') return response()->json(['status' => 'success']);
    	else Chat::create([
    		'msg' => $req->msg,
    		'user_id' => $userId,
    		'chat_with' => $chatWith
    	]);
    	return response()->json(['status' => 'success']);
    }
}
