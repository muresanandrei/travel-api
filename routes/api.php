<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/travel', 'App\Http\Controllers\Api\TravelController@index');
    // Route::get('/travel/{id}', 'App\Http\Controllers\Api\TravelController@show');
    // Route::post('/travel', 'App\Http\Controllers\Api\TravelController@store');
    // Route::put('/travel/{id}', 'App\Http\Controllers\Api\TravelController@update');
    // Route::delete('/travel/{id}', 'App\Http\Controllers\Api\TravelController@destroy');

    // Route::get('/tour', 'App\Http\Controllers\Api\TourController@index');
    // Route::get('/tour/{id}', 'App\Http\Controllers\Api\TourController@show');
    // Route::post('/tour', 'App\Http\Controllers\Api\TourController@store');
    // Route::put('/tour/{id}', 'App\Http\Controllers\Api\TourController@update');
    // Route::delete('/tour/{id}', 'App\Http\Controllers\Api\TourController@destroy');
});
Route::get('user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Auth Routes
Route::group(['namespace' => 'App\Http\Controllers\Api\Auth'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
});
