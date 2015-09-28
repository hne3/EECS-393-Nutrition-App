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

Route::get('food/{sort}', function ($sort) {
    if ($sort == 'id') {
        return \App\Http\Controllers\NutritionAPI::Food()->sortByID()->get();
    } else if ($sort == 'name') {
        return \App\Http\Controllers\NutritionAPI::Food()->sortByName()->get();
    } else {
        return view('welcome');
    }
});

Route::get('food', function () {
    return \App\Http\Controllers\NutritionAPI::Food()->get();
});

Route::get('nutrients/{sort}', function ($sort) {
    if ($sort == 'id') {
        return \App\Http\Controllers\NutritionAPI::Nutrients()->sortByID()->get();
    } else if ($sort == 'name') {
        return \App\Http\Controllers\NutritionAPI::Nutrients()->sortByName()->get();
    } else {
        return view('welcome');
    }
});

Route::get('nutrients', function () {
    return \App\Http\Controllers\NutritionAPI::Nutrients()->get();
});

Route::get('savefood','FoodRepository@saveFood');