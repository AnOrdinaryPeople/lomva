<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\Recaptcha;

class AuthController extends Controller
{
	public function register(Request $req, Recaptcha $recap){
    	$check = Validator::make($req->all(), [
    		'email' => 'required|email|unique:users',
    		'password' => 'required|min:8|confirmed',
            'recaptcha' => ['required', $recap]
    	]);

    	if($check->fails())
    		return response()->json([
	    		'status' => 'error',
	    		'errors' => $check->errors()
	    	], 422);
    	else{
    		User::create([
                'name' => 'user',
    			'email' => $req->email,
    			'password' => Hash::make($req->password),
                'role' => $req->role
    		]);

    		return response()->json(['status' => 'success']);
    	}
    }

    public function login(Request $req){
    	$token = Auth::guard()->attempt($req->only('email', 'password'));

    	if($token) return response()->json(['status' => 'success'])
    		->header('Authorization', $token);
    	else return response()->json(['status' => 'error'], 401);
    }

    public function logout(){
    	Auth::guard()->logout();

    	return response()->json([
    		'status' => 'success',
    		'msg' => 'Berhasil logout'
    	]);
    }

    public function user(Request $req){
    	return response()->json([
    		'status' => 'success',
    		'data' => User::find(Auth::user()->id)
    	]);
    }

    public function refresh(){
    	if($token = Auth::guard()->refresh()) return response()
            ->json(['status' => 'success'], 200)
            ->header('Authorization', $token);
        else return response()->json(['status' => 'refresh_token_error'], 401);
    }
}
