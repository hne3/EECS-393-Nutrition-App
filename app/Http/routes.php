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
    return view('welcome');
});

Route::get('/homepage1', function () {
	return view('homepage1');
});

Route::get('/homepage2', function () {
	return view('homepage2');
});

Route::get('login', function () {
	return view('/auth/login');
});

Route::get('/register', function () {
	return view('/auth/register');
});

Route::get('/logout', function () {
	Auth::logout();
    return view('homepage1');
});

/*
//Login routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');*/

Route::controllers(
	['auth'=>'Auth\AuthController','password'=>'Auth\PasswordController']);
// Need route for