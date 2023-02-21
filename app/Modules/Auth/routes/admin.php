<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('authroute.prefix.backend'),
    'namespace' => config('authroute.namespace.backend'),
    'as' => config('authroute.as.backend'),
    'middleware' => ['web']

], function () {

    Route::get('/login', 'AuthController@login')->name('login');

    Route::post('login-submit', 'AuthController@loginSubmit')->name('loginSubmit');




    Route::group([
        // 'middleware' => 'adminMiddleware'
    ], function () {
        Route::get('dashboard', 'AuthController@dashboard')->name('dashboard');

        Route::get('/logout', 'AuthController@logout')->name('logout');

        Route::post('/change-password-submit', 'AuthController@changeUserPasswordSubmit')->name('changePasswordSubmit');

        Route::get('/profile', 'AuthController@userProfile')->name('userProfile');

        Route::post('/profile/update/submit', 'AuthController@userProfileUpdate')->name('userProfileUpdate');
    });
});
