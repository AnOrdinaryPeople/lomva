<?php

Route::prefix('auth')->group(function(){
	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
	Route::get('refresh', 'AuthController@refresh');
	
	Route::group(['middleware' => ['web']], function(){
		Route::get('{provider}/redirect', 'OutController@redirectToProvider');
		Route::get('{provider}/callback', 'OutController@handleProviderCallback');
	});

	Route::group(['middleware' => 'auth:api'], function(){
		Route::get('user', 'AuthController@user');
		Route::post('logout', 'AuthController@logout');
	});
});

Route::post('/user-profile/{id}', 'UserController@sendData');
Route::post('/user-profile/{id}/save', 'UserController@store');

Route::post('/all-post/{check}', 'UserController@allPost');
Route::post('/all-post/{check}', 'UserController@allPost');
Route::post('/get-post/{id}', 'UserController@getPost');
Route::post('/post-save/{id}', 'UserController@savePost');
Route::post('/my-post/{id}', 'UserController@getUserPost');
Route::delete('/my-post/delete/{id}', 'UserController@destroy');
Route::post('/my-post/edit/{id}', 'UserController@getThisPost');
Route::post('/post-update/{id}', 'UserController@updatePost');
Route::post('/post-search', 'UserController@search');