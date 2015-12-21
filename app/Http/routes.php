<?php
namespace App;

use App\PostProcessor\PostProcessor;
use \Route;

/*
 * Clearboard Routes
 */

Route::get('/', function() {
    return view('clearboard.pages.index', ['forums' => Forum::all()]);
});

Route::get('/forum/{fid}-{_}', 'ForumController@getForum');
Route::get('/thread/{tid}-{_}', 'ThreadController@getThread');
Route::get('/profile/{uid}-{_}', 'ProfileController@getProfile');

// Route for processing markdown to HTML.
Route::post('/ajax/markdown', 'MarkdownController@postParse');
Route::post('/ajax/markdown_inline', 'MarkdownController@postInlineParse'); // for parsing inline markdown

// Posting routes
Route::post('/ajax/new_post', 'PostController@newPost')->middleware('auth');
Route::post('/ajax/new_thread', 'ThreadController@newThread')->middleware('auth');
Route::get('/newthread/{forumid}', 'ThreadController@createThread')->middleware('auth');

// Account Settings
Route::get('/settings/{userid}', 'SettingsController@view');
Route::get('/settings', 'SettingsController@view')->middleware('auth');

// Registration
Route::get('/register', function(){
    return view('clearboard.pages.register');
});
Route::post('/ajax/register', 'LoginController@postRegister');

// Authentication routes
Route::group(array('prefix' => '/auth'), function() {
    Route::post('/login', 'LoginController@postLogin');
    Route::get('/logout', 'Auth\AuthController@getLogout');
    Route::post('/check', 'LoginController@verifyPassword');
});


// Introduction route. Probably will be a way to disable at some point.
Route::get('/clearboard/welcome', function () {
    return view('clearboard.welcome');
});

