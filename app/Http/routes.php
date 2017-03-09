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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/','WelcomeController@index');
Route::get('/', function() {
    return redirect('/blog');
});
Route::auth();

Route::get('/home', 'HomeController@index');

// github
Route::get('auth/github','Auth\AuthController@redirectToGitHub');
Route::get('auth/github/callback','Auth\AuthController@handleGitHubCallback');


// 322p ~ 323p
// 인증을 거쳐야 할 수 있는 기능들
Route::group(['middleware' => 'auth'], function() {
    Route::resource('project', 'ProjectController');
    Route::resource('project.task', 'ProjectTaskController');
    Route::resource('task','TaskController',['only' => ['index', 'show']]);
});

