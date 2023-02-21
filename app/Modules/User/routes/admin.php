<?php

use Illuminate\Support\Facades\Route;

Route::group(
[
    'prefix' => config('userRoute.prefix.backend'),
    'namespace' => config('userRoute.namespace.backend'),
    'as' => config('userRoute.as.backend'),
    'middleware' => ['web','adminMiddleware']
],
function () {
    

    // Route::group(['middleware' =>'role:admin' ],function(){

        Route::get('/profile','UserController@userProfile')->name('userProfile');

        Route::post('/profile/update','UserController@userProfileUpdate')->name('userProfileUpdate');    

        Route::post('/password/update','UserController@userPasswordUpdate')->name('userPasswordUpdate');    


        Route::get('/','UserController@index')->name('index');

        Route::post('/store', 'UserController@store')->name('store');

        Route::post('/update/{id}', 'UserController@update')->name('update');

        Route::get('/destroy/{id}', 'UserController@destroy')->name('destroy');

        Route::get('/edit/{id}', 'UserController@edit')->name('edit');

        Route::get('/show/{id}', 'UserController@show')->name('show');

        Route::get('/get-user-data', 'UserController@getUserData')->name('getUserData');

        Route::get('/trashed', 'UserController@trashedIndex')->name('trashedIndex');

        Route::get('/{id}/trashedDelete', 'UserController@trashedDestroy')->name('trashedDestroy');

        Route::get('/{id}/trashedRecover', 'UserController@trashedRecover')->name('trashedRecover');

 


});
