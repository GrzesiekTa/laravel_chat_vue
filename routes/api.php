<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthApiController@login');
    Route::post('logout', 'Auth\AuthApiController@logout');
    Route::post('refresh', 'Auth\AuthApiController@refresh');
    Route::get('me', 'Auth\AuthApiController@me');
});