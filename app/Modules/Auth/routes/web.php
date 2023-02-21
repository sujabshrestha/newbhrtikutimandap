<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('authroute.prefix.frontend'),
    'namespace' => config('authroute.namespace.frontend'),
    'as' => config('authroute.as.frontend'),
    'middleware' => ['web'],

],function(){


    // Route::get('register', 'AuthWebController@register')->name('register');

    // Route::post('signup', 'AuthWebController@signUp')->name('signUp');

    // Route::get('login', 'AuthWebController@login')->name('login');

    // Route::get('user/verify/{email}/{token}', 'AuthWebController@verify')->name('verify');

    // Route::post('signin', 'AuthWebController@signIn')->name('signIn');






});






