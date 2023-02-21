<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('authroute.prefix.vendor'),
    'namespace' => config('authroute.namespace.vendor'),
    'as' => config('authroute.as.vendor'),
    'middleware' => ['web']

], function () {

    Route::get('/', 'AuthVendorController@login')->name('login');

    Route::post('login-submit', 'AuthVendorController@loginSubmit')->name('loginSubmit');

    Route::get('/register','AuthVendorController@register')->name('register');

    Route::post('/register-submit','AuthVendorController@registerSubmit')->name('registersubmit');

    Route::get('/verify/{id}', 'AuthVendorController@verify')->name('verify');

    // Route::get('/password-reset','AuthController@passwordReset')->name('passwordReset');

    // Route::post('/forgot-password','AuthController@forgetPassword')->name('forgetPassword');

    // Route::get('/reset-password/{token}','AuthController@showResetPasswordForm')->name('reset.password.show');

    // Route::post('/reset-password-form','AuthController@resetPasswordFormSubmit')->name('resetPasswordFormSubmit');





    Route::get('forget-password', 'AuthVendorController@forgetPassword')->name('forgetPassword');

    Route::post('forgetPassword-submit', 'AuthVendorController@forgetPasswordSubmit')->name('forgetPasswordSubmit');

    Route::get('resetpassword/{email}/{token}', 'AuthVendorController@resetPassword')->name('resetPassword');

    Route::post('recoverpassword/{email}', 'AuthVendorController@recoverPassword')->name('recoverPassword');


    Route::group([
        'middleware' => 'vendorMiddleware'
    ], function () {
        // Route::get('index', 'AuthVendorController@index')->name('index');

        Route::get('/logout', 'AuthVendorController@logout')->name('logout');

        Route::post('/change-password-submit', 'AuthVendorController@changeUserPasswordSubmit')->name('changePasswordSubmit');

        // Route::get('/profile', 'AuthVendorController@userProfile')->name('userProfile');

        // Route::post('/profile/update/submit', 'AuthVendorController@userProfileUpdate')->name('userProfileUpdate');
    });
});
