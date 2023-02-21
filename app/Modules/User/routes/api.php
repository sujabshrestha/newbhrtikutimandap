<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('userRoute.prefix.api'),
    'namespace' => config('userRoute.namespace.api'),
],
function(){

    Route::group([
        "middleware" => ["auth:api"]
    ],
    function(){

    });

});

