<?php
namespace App;

use \Route;

/*
 * Clearboard Routes
 */

Route::get('/', function() {
    return view('clearboard.pages.index', ['forums' => Forum::all()]);
});

Route::get('/forum/{fid}-{_}', 'ForumController@getForum');
Route::get('/thread/{tid}-{_}', 'ThreadController@getThread');

// Authentication routes
Route::group(array('prefix' => '/auth'), function() {
    Route::post('login', 'LoginController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
});


// Introduction route. Probably will be a way to disable at some point.
Route::get('/welcome', function () {
    return view('clearboard.welcome');
});

