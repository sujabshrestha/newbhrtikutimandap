<?php

use Illuminate\Support\Facades\Route;

Route::group(
[
    'prefix' => config('venueRoute.prefix.backend'),
    'namespace' => config('venueRoute.namespace.backend'),
    'as' => config('venueRoute.as.backend'),
    'middleware' => ['web', 'adminMiddleware']
],
function () {


    Route::get('index', 'VenueController@index')->name('index');

    Route::get('create', 'VenueController@create')->name('create');

    Route::post('store', 'VenueController@store')->name('store');

    Route::get('edit/{slug}', 'VenueController@edit')->name('edit');

    Route::post('update/{slug}', 'VenueController@update')->name('update');

    Route::get('delete/{slug}', 'VenueController@delete')->name('delete');




});
