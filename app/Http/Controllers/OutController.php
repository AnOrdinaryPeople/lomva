<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class OutController extends Controller
{
    public function redirectToProvider($provider){
    	return response()->json(['uri' => Socialite::driver($provider)
    		->stateless()
    		->redirect()
    		->getTargetUrl()]);
    }
    public function handleProviderCallback($provider){
    	$user = Socialite::driver($provider)->stateless()->user();
        $email = empty($user->email) ? $user->id.'@efbih.bpi' : $user->email;
        $pass = Hash::make($user->email.$user->id);

    	if(!User::where('email', $email)->first()) User::create([
	    	'email_verified_at' => Carbon::now(),
	    	'provider_id' => $user->id,
	    	'name' => $user->name,
	    	'email' => $email,
	    	'avatar' => $user->avatar,
            'password' => $pass
	    ]);

    	return redirect('/login?token='.base64_encode(json_encode(['email' => $email, 'pass' => $user->email.$user->id])));
    }
}
