<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('cmsRoute.prefix.api'),
    'middleware' => 'auth:api',
    'namespace' => config('cmsRoute.namespace.api'),
], function () {
    Route::get('all', 'ApiNagarikWardController@all');
});
