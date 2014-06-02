<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::model('post','Post');
Route::model('user','User');
Route::resource('post', 'IndexController');

Route::get('/post/{post}', 'PostController@showPost');

Route::get('/', 'IndexController@getIndex');
Route::get('/login', 'IndexController@showLogin');
Route::post('/login', array('uses' => 'IndexController@doLogin'));
Route::get('/logout', 'IndexController@doLogout');
Route::get('/login/fb', 'IndexController@doFbLogin');
Route::get('/login/gp', 'IndexController@doGoogleLogin');
Route::get('/login/fb/callback', 'IndexController@doFbLoginCallback');

Route::post('/vote', 'IndexController@vote');

Route::get('/getpage', 'IndexController@getPage');

Route::get('users', function()
{
    return View::make('users');
});

