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
Route::post('/my-post/edit/{id}/{userId}', 'UserController@getThisPost');
Route::post('/post-update/{id}', 'UserController@updatePost');
Route::post('/post-search', 'UserController@search');

Route::prefix('questionnaire')->group(function(){
	Route::post('all-quest', 'QuestController@getAll');
	Route::post('search', 'QuestController@search');
	Route::post('{id}', 'QuestController@getThisQuest');
	Route::post('test/{id}/{userId}', 'QuestController@test');
	Route::post('{id}/score/{userId}', 'QuestController@score');
});

Route::prefix('quest')->group(function(){
	Route::post('teacher/{id}', 'QuestController@getOwnQuest');
	Route::post('teacher/{id}/send', 'QuestController@store');
	Route::post('teacher/{id}/edit/{userId}', 'QuestController@edit');
	Route::post('teacher/{id}/update/{userId}', 'QuestController@update');
	Route::delete('teacher/{id}/destroy', 'QuestController@destroy');
	Route::post('done/{id}/{userId}', 'QuestController@getDone');
	Route::post('done/user/{id}/{userId}', 'QuestController@getUserDone');
});

Route::prefix('chat')->group(function(){
	Route::post('list/{id}/{role}', 'ChatController@getAll');
	Route::post('open/{id}/{userId}', 'ChatController@getChat');
	Route::post('send/{userId}/{chatWith}', 'ChatController@sendChat');
});

Route::post('check-profile/{id}', 'UserController@checkProfile');

Route::post('students', 'UserController@getStudents');

Route::prefix('admin')->group(function(){
	Route::post('/count', 'AdminController@countAll');
	Route::post('/search/{n}', 'AdminController@search');
	Route::post('/all/{n}', 'AdminController@teacher');
	Route::post('/add', 'AdminController@add');
	Route::post('/update/{id}', 'AdminController@update');
	Route::delete('/delete/{id}', 'AdminController@destroy');
	Route::delete('/delete/student/{id}', 'AdminController@destroyStudent');

	Route::post('/post', 'AdminController@getPost');
	Route::post('/post/search', 'AdminController@searchPost');

	Route::post('/quest', 'AdminController@getQuest');
	Route::post('/quest/get/{id}', 'AdminController@getThisQuest');
	Route::post('/quest/search', 'AdminController@questSearch');
});
