<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Chat;
use App\Done;
use App\Comment;
use App\Profile;
use App\Question;
use App\Questionnaire as Quest;
use App\Result;
use App\UserPost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function countAll(){
    	return response()->json([
    		'post' => UserPost::all()->count(),
    		'quest' => Quest::all()->count(),
    		'teacher' => User::where('role', 1)->count(),
    		'student' => User::where('role', 0)->count()
    	]);
    }
    public function teacher($n){
    	return response()->json(User::getTeacher($n));
    }
    public function add(Request $req){
    	$check = Validator::make($req->all(), [
    		'email' => 'required|email|unique:users',
    		'name' => 'required|string',
    		'password' => 'required|min:8',
    		'school' => 'required|string'
    	]);
    	if($check->fails())
    		return response()->json($check->errors(), 422);
    	else{
    		$user = User::create([
    			'email' => $req->email,
    			'name' => $req->name,
    			'password' => Hash::make($req->password),
    			'role' => 1
    		]);
    		Profile::create([
    			'school' => $req->school,
    			'user_id' => $user->id
    		]);

	    	return response()->json(['status' => 'success']);
    	}
    }
    public function update($id, Request $req){
    	$check = Validator::make($req->all(), [
    		'name' => 'required|string',
    		'password' => 'nullable|min:8',
    		'school' => 'required|string'
    	]);
    	if($check->fails())
    		return response()->json($check->errors(), 422);
    	else{
    		$user = User::find($id);
    		$data = ['name' => $req->name];

    		if(!empty($req->password)) $data['password'] = Hash::make($req->password);

    		$user->update($data);
    		Profile::where('user_id', $user->id)->update(['school' => $req->school]);

	    	return response()->json(['status' => 'success']);
    	}
    }
    public function destroy($id){
    	Chat::where('chat_with', $id)->delete();
    	Chat::where('user_id', $id)->delete();

    	Comment::where('user_id', $id)->delete();
    	$post = UserPost::where('user_id', $id);
    	foreach($post->get() as $p){
	    	Comment::where('post_id', $p->id)->delete();
    	}
    	$post->delete();
    	
    	$quest = Quest::where('user_id', $id);
    	foreach($quest->get() as $key){
    		$question = Question::where('quest_id', $key->id);

    		foreach($question->get() as $q)
    			Answer::where('q_id', $q->id)->delete();

    		$question->delete();
    		Done::where('quest_id', $key->id)->delete();
    		Result::where('quest_id', $key->id)->delete();
    	}
    	$quest->delete();

    	$user = User::find($id);
    	Profile::where('user_id', $id)->delete();
    	Storage::disk('public_upload')->delete(str_replace(url('/').'/','',$user->avatar));
    	$user->delete();

    	return response()->json(['status' => 'success']);
    }
    public function search($n, Request $req){
    	return response()->json(User::search($req['query'], $n));
    }
    public function destroyStudent($id){
    	Chat::where('chat_with', $id)->delete();
    	Chat::where('user_id', $id)->delete();

    	Comment::where('user_id', $id)->delete();
    	$post = UserPost::where('user_id', $id);
    	foreach($post->get() as $p){
	    	Comment::where('post_id', $p->id)->delete();
    	}
    	$post->delete();

    	Done::where('user_id', $id)->delete();

    	$user = User::find($id);
    	Profile::where('user_id', $id)->delete();
    	Storage::disk('public_upload')->delete(str_replace(url('/').'/','',$user->avatar));
    	$user->delete();

    	return response()->json(['status' => 'success']);
    }
    public function getPost(){
    	return response()->json(UserPost::getAll());
    }
    public function searchPost(Request $req){
    	return response()->json(UserPost::searchPost($req['query']));
    }
    public function getQuest(){
    	return response()->json(Quest::getQuest());
    }
    public function questSearch(Request $req){
    	return response()->json(Quest::questSearch($req['query']));
    }
    public function getThisQuest($id){
    	return response()->json([
    		'info' => Quest::find($id),
    		'question' => Question::test($id),
    		'result' => Result::getResult($id)
    	]);
    }
}
