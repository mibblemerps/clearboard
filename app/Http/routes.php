<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('clearboard.welcome');
});

Route::get('/test', function() {
    return view('clearboard.pages.index');
});

/* AUTHENTICATION ROUTES */
Route::post('auth/login', 'Auth\AuthController@authAjax');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
