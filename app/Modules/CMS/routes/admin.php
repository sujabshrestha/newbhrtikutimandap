<?php

use CMS\Http\Controllers\Gallery\GalleryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('cmsRoute.prefix.backend'),
    'namespace' => config('cmsRoute.namespace.backend'),
    'middleware' => ['web'],
    'as' => config('cmsRoute.as.backend'),


], function () {

    Route::group([
        'prefix' => 'gallery',
        'middleware' => 'adminMiddleware',
        'as' => 'gallery.'
    ], function(){
        Route::get('index', 'GalleryController@index')->name('index');

        Route::get('create', 'GalleryController@create')->name('create');

        Route::get('edit/{id}', 'GalleryController@edit')->name('edit');

        Route::post('store', 'GalleryController@store')->name('store');
        Route::post('update/{id}', 'GalleryController@update')->name('update');

        Route::get('delete/{id}', 'GalleryController@destroy')->name('delete');
    });
});
