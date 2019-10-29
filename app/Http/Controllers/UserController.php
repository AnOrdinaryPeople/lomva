<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\UserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function sendData($id){
    	return response()->json(Profile::getData($id));
    }
    public function store($id, Request $req){
    	$user = User::find($id);
    	$data['name'] = $req->name;
    	$prof = [
    		'phone' => $req->phone,
    		'gender' => $req->gender,
    		'cls' => $req->cls,
    		'school' => $req->school,
    		'born' => $req->born
    	];

    	if(!empty($req->pass)){
    		if(strlen($req->pass) <= 8) $errors[] = 'The password must be at least 8 characters.';
    		if($req->pass != $req->passCon) $errors[] = 'The password confirmation does not match.';

    		if(!empty($errors) && count($errors))
    			return response()->json(['status' => 'error','errors' => $errors], 422);
    		else $data['password'] = Hash::make($req->pass);
    	}
    	
    	if(!empty($req->file('avatar')) && !empty($user->avatar)){
    		Storage::disk('public_upload')->delete($user->avatar);
			$data['avatar'] = $req->file('avatar')->store('pic','public_upload');
    	}else if(!empty($req->file('avatar')))
			$data['avatar'] = $req->file('avatar')->store('pic','public_upload');
    	
    	$user->update($data);
    	
    	if(Profile::where('user_id', $id)->first())
    		$user->profile()->update($prof);
    	else $user->profile()->create($prof);

    	return response()->json(['status' => 'saved']);
    }
    public function savePost($id, Request $req){
    	$check = Validator::make($req->all(), [
    		'type' => 'required|min:0|max:1',
    		'title' => 'required|string',
    		'desc' => 'required|string'
    	]);

    	if($check->fails()) return response()
    		->json(['status' => 'error', 'errors' => $check->errors()], 422);
    	else{
    		$data = User::find($id)->userPost()->create($req->all());

    		return response()->json(['url' => '/post/'.$data->id]);
    	}
    }
    public function getPost($id){
    	return response()->json(UserPost::getPost($id));
    }
    public function allPost($check){
    	return response()->json(UserPost::allPost($check));
    }
    public function getUserPost($id){
    	$data = UserPost::getUserPost($id);
    	return response()->json(['data' => $data, 'total' => $data->count()]);
    }
    public function getThisPost($id){
    	return response()->json(UserPost::find($id));
    }
    public function updatePost($id, Request $req){
    	$check = Validator::make($req->all(), [
    		'type' => 'required|min:0|max:1',
    		'title' => 'required|string',
    		'desc' => 'required|string'
    	]);

    	if($check->fails()) return response()
    		->json(['status' => 'error', 'errors' => $check->errors()], 422);
    	else{
    		$data = UserPost::find($id);

    		$data->update($req->all());
    		return response()->json(['url' => '/post/'.$data->id]);
    	}
    }
    public function destroy($id){
    	UserPost::destroy($id);
    	return response()->json(['status' => 'success']);
    }
    public function search(Request $req){
    	return response()->json(UserPost::search($req->search, $req->role));
    }
}
