<?php

use Illuminate\Support\Facades\Route;

//Auth::routes();
Route::get('/{any}', 'MainController@index')->name('main')->where('any', '.*');