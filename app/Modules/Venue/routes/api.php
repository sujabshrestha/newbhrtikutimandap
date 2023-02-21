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

        Route::get('/profile','UserApiController@show');

        Route::post('/update','UserApiController@userProfileUpdate');

        Route::post('/change-password','UserApiController@changeUserPassword');

        Route::post('/select-package','UserApiController@userPackageStore');

        Route::get('/check-interests-lists','UserApiController@checkInterests');

        Route::get('/user-interests-lists','UserApiController@userInterestList');

        Route::post('/user-interests-store','UserApiController@userInterestStore');

        Route::post('/user-interests-update','UserApiController@userInterestUpdate');

        Route::get('/all-wishlists','UserApiController@wishlists');

        Route::post('/wishlist-store','UserApiController@wishlistStore');

        Route::post('/wishlist-delete','UserApiController@wishlistDelete');

        Route::get('/user-tender-filter','UserApiController@userWishlistFilter');


        // Route::group([
        //     'middleware' => ['packageMiddleware']
        // ],
        // function(){
        //     Route::get('/all-wishlists','UserApiController@wishlists');

        //     Route::post('/wishlist-store','UserApiController@userInterestStore');

        //     Route::post('/wishlist-delete','UserApiController@wishlistDelete');
        // });

    });

    Route::group([
        'prefix' => 'package',
    ],
    function(){
            Route::get('/','PackageApiController@index');

            // Route::get('/show/{id}','PackageApiController@show');
    });

});

