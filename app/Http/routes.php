<?php
namespace App;

use App\PostProcessor\PostProcessor;
use Illuminate\Http\Request;
use \Route;

/*
 * Clearboard Routes
 */

Route::get('/', function() {
    return view('clearboard.index.viewindex', ['forums' => Forum::all()]);
});

Route::get('/forum/{fid}-{_}', 'ForumController@getForum');
Route::get('/thread/{tid}-{_}', 'ThreadController@getThread');
Route::get('/profile/{uid}-{_}', 'ProfileController@getProfile');
Route::get('/forum', function() {
    return redirect('/');
});

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

Route::get('/test', function(Request $session) {
    $session->session()->put('sudo', time());
});
Route::get('/test2', function(Request $request) {
    echo Authorization\Sudo::isSudo($request) ? 'sudo' : 'not sudo';
});

// Registration
Route::get('/register', function(){
    return view('clearboard.register.register');
});
Route::post('/ajax/register', 'RegisterController@postRegister');

// Authentication routes
Route::group(array('prefix' => '/auth'), function() {
    Route::post('/login', 'Auth\AuthController@postAjaxLogin');
    Route::get('/logout', 'Auth\AuthController@getLogout')->middleware('get_csrf');
    Route::post('/sudo', 'Auth\AuthController@postSudo');
});


// Introduction route. Probably will be a way to disable at some point.
Route::get('/clearboard/welcome', function () {
    return view('clearboard.welcome');
});

