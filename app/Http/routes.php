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

Route::get('food',['uses'=>'FoodSearchController@index','as'=>'FoodSearch']);


Route::get('/', function () {
    if(Auth::check()){
        return redirect('home');
    } else {
        return view('welcome');
    }
});

Route::get('login', function () {
	return view('/auth/login');
});

Route::get('/register', function () {
	return view('/auth/register');
});

Route::get('/logout', function () {
	Auth::logout();
	return redirect('home');
});

Route::get('/home', function () {
	return view('home', ['username' => Auth::user()['name']]);
});

Route::get('food',['uses'=>'FoodSearchController@index','as'=>'food_search',
	'middleware'=>'auth'
]);

Route::post('food',['uses'=>'FoodHistoryController@addFood','as'=>'addFood',
	'middleware'=>'auth'
]);

Route::get('suggestion',['uses'=>'SuggestionController@index','as'=>'suggestion',
	'middleware'=>'auth'
]);

Route::get('history', ['middleware'=>'auth','uses'=>'FoodHistoryController@index','as'=>'foodhistory']);

Route::get('map', function() {
	return view('map');
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
