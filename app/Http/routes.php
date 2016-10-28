<?php
namespace App;

use Illuminate\Support\Facades\Route;

/*
 * Clearboard Routes
 */

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function() {
        return view('clearboard.index.viewindex', ['forums' => Forum::all()]);
    });


    Route::get('/forum/{fid}-{_}', 'ForumController@view');
    Route::get('/thread/{tid}-{_}', 'ThreadController@view');
    Route::get('/profile/{uid}-{_}', 'ProfileController@view');
    Route::get('/forum', function() {
        return redirect('/');
    });

    // Route for processing markdown to HTML.
    Route::post('/ajax/markdown', 'MarkdownController@postParse');
    Route::post('/ajax/markdown_inline', 'MarkdownController@postInlineParse'); // for parsing inline markdown

    // Posting routes
    Route::post('/ajax/new_post', 'PostController@apiCreate')->middleware('auth');
    Route::post('/ajax/new_thread', 'ThreadController@apiCreate')->middleware('auth');
    Route::get('/newthread/{forumid}', 'ThreadController@create')->middleware('auth');

    // Account Settings
    Route::get('/settings/{userid}', 'SettingsController@view');
    Route::get('/settings', 'SettingsController@view')->middleware('auth');

    // Registration
    Route::get('/register', function(){
        return view('clearboard.register.register');
    });
    Route::post('/ajax/register', 'RegisterController@apiRegister');

    // Authentication routes
    Route::group(array('prefix' => '/auth'), function() {
        Route::post('/login', 'Auth\AuthController@apiLogin');
        Route::get('/logout', 'Auth\AuthController@getLogout')->middleware('get_csrf');
        Route::post('/sudo', 'Auth\AuthController@apiSudo');
        Route::get('/ping', function () { return ''; }); // a simple request that returns nothing to update the existence of a user.
    });

    // Introduction route. Probably will be a way to disable at some point.
    Route::get('/clearboard/welcome', function () {
        return view('clearboard.welcome');
    });
});


