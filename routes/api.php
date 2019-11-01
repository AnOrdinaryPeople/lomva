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
Route::post('/get-post/{id}/send-reply/{userId}', 'UserController@sendReply');
Route::post('/reply-update/{id}/{postId}', 'UserController@replyUpdate');
Route::delete('/reply-delete/{id}/{postId}', 'UserController@replyDestroy');
Route::post('/post-save/{id}', 'UserController@savePost');
Route::post('/my-post/{id}', 'UserController@getUserPost');
Route::delete('/my-post/delete/{id}', 'UserController@destroy');
Route::post('/my-post/edit/{id}', 'UserController@getThisPost');
Route::post('/post-update/{id}', 'UserController@updatePost');
Route::post('/post-search', 'UserController@search');

Route::prefix('questionnaire')->group(function(){
	Route::post('all-quest', 'QuestController@getAll');
	Route::post('search', 'QuestController@search');
	Route::post('{id}', 'QuestController@getThisQuest');
	Route::post('test/{id}', 'QuestController@test');
});

Route::prefix('quest')->group(function(){
	Route::post('teacher/{id}', 'QuestController@getOwnQuest');
	Route::post('teacher/{id}/send', 'QuestController@store');
	Route::post('teacher/{id}/edit', 'QuestController@edit');
	Route::post('teacher/{id}/update/{userId}', 'QuestController@update');
	Route::delete('teacher/{id}/destroy', 'QuestController@destroy');
});