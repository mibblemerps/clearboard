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

Route::get('/', function() {
    return view('clearboard.pages.index', ['forums' => \App\Forum::all()]);
});

Route::get('/forum/{fid}-{_}', function($fid) {
    $forum = \App\Forum::where('id', $fid)->first();
    return view('clearboard.pages.forum', ['forum' => $forum]);
});

Route::get('/welcome', function () {
    return view('clearboard.welcome');
});

/* AUTHENTICATION ROUTES */
Route::post('auth/login', 'LoginController@authenticateJson');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
