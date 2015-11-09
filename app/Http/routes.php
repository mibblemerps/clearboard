<?php
namespace App;

use \Route;

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
    return view('clearboard.pages.index', ['forums' => Forum::all()]);
});

Route::get('/forum/{fid}-{_}', function($fid) {
    $forum = Forum::where('id', $fid)->first();
    if ($forum->type == 0) { // Viewing standard forum
        return view('clearboard.pages.forum', ['forum' => $forum]);
    } elseif ($forum->type == 1) { // Viewing category
        // @TODO implement viewing of categories
        abort(501); // Not Implemented
    } elseif ($forum->type == 2) { // Viewing redirect
        $redirect = $forum->meta;
        return redirect($redirect);
    }
});

Route::get('/thread/{tid}-{_}', function($tid) {
    $thread = Thread::where('id', $tid)->firstOrFail();

    if ($thread->hidden) {
        // Thread hidden, abort request
        abort(403);
    }

    return view('clearboard.pages.thread', ['thread' => $thread]);
});

Route::get('/welcome', function () {
    return view('clearboard.welcome');
});

/* AUTHENTICATION ROUTES */
Route::group(array('prefix' => '/auth'), function() {
    Route::post('login', 'LoginController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
});

