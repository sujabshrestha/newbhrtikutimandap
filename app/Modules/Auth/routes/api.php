<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix'=>config('authroute.prefix.api'),
    'namespace' => config('authroute.namespace.api'),


],function(){


    // Route::post('/login','AuthApiController@loginSubmit');

    // Route::post('/register-submit','AuthApiController@registerSubmit');

    // Route::post('/verify-user','AuthApiController@emailVerifyUser');

    // Route::post('/forget-password','AuthApiController@forgetPasswordSubmit');

    // Route::post('/reset-password-submit','AuthApiController@verifyForgetpasswordOtp')->name('verifyForgetpasswordOtp');

    // Route::post('/request-otp','AuthApiController@sendOtp');

    // Route::post('/verify-otp','AuthApiController@verifyOtp');


    // Route::post('/logout','AuthApiController@logout')->middleware(['web','auth:api']);



    // Route::get('/userDetails','AuthApiController@userDetails')->middleware('auth:api');





});



