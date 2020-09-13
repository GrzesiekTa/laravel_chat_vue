<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthApiController@login');
    Route::post('logout', 'Auth\AuthApiController@logout');
    Route::post('refresh', 'Auth\AuthApiController@refresh');
    Route::get('me', 'Auth\AuthApiController@me');
    //Route::post('user/{user}', 'Api\User\UserController@update');
    Route::resource('/user', 'Api\User\UserController', ['only' => ['create', 'store', 'index', 'show', 'edit', 'update', 'destroy']]);
    //Route::resource('/user', 'Api\User\UserController');
    Route::get('messages', 'Api\Massage\MassageController@fetchMessages');
    Route::post('messages', 'Api\Massage\MassageController@sendMessages');

    Route::get('conversations', 'Api\Conversation\ConversationUserController@testttt');
    Route::get('countUnreadMessages', 'Api\Conversation\ConversationUserController@countUnreadMessages');
});
