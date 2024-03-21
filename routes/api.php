<?php

use Illuminate\Support\Facades\Route;

//Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
        //Logout
        Route::post('logout', 'Auth\LogOffController@logout')->name('api.logout');

        //Editor endpoints
        Route::group(['prefix' => 'editor', 'namespace' => 'Editor'], function () {
            Route::post('travel/{travelId}/update', 'TravelController@update')->middleware('can:update-travel');
        });

        //Admin endpoints
        Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
            Route::post('travel/create', 'TravelController@store')->middleware('can:create-travel');
            Route::post('tour/create', 'TourController@store')->middleware('can:create-tour');
        });

    });

});

//Auth Routes
Route::group(['namespace' => 'App\Http\Controllers\Api\Auth'], function () {
    Route::post('login', 'LoginController@login')->name('login')->name('api.login');
    Route::post('register', 'RegisterController@register')->name('api.register');
});
