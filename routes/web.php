<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'MainController@index')->name('main');
Route::get('/home', 'HomeController@index')->name('home');