<?php

use App\Events\WebsocketDemoEvent;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;

//Auth::routes();

Route::get('/demo', function(){
    broadcast(new WebsocketDemoEvent('some data'));
    return View('welcome');
});


Route::get('/{any}', 'MainController@index')->name('main')->where('any', '.*');