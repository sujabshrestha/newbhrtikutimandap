<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => config('vendorRoute.prefix.vendor'),
        'namespace' => config('vendorRoute.namespace.vendor'),
        'as' => config('vendorRoute.as.vendor'),
        'middleware' => ['web']
    ],
    function () {

        Route::get('/terms-services', 'VendorController@termsAndCondition')->name('termsAndCondition');


        Route::group([
            'middleware' => 'vendorMiddleware'
        ], function () {
            Route::get('/', 'VendorController@home')->name('home');

            Route::get('/mark-notification-read', 'VendorController@markNotificationRead')->middleware('auth')->name('markNotificationRead');

            Route::get('/gallery', 'VendorController@gallery')->name('gallery');



            Route::get('/about', 'VendorController@about')->name('about');

            Route::get('/rules', 'VendorController@rules')->name('rules');

            Route::get('/my-account', 'VendorController@myAccount')->name('myAccount');

            Route::get('/my-booking', 'VendorController@myBooking')->name('myBooking');

            Route::get('/my-booking-details/{id}', 'VendorController@myBookingDetails')->name('myBookingDetails');



            Route::get('/booking-details-view-modal/{id}', 'VendorController@bookingDetailsViewModal')->name('bookingdetails.view.modal');


            Route::get('/booking-cancel-modal/{id}', 'VendorController@bookingCancelModal')->name('bookingCancelModal');

            Route::post('/booking-cancel-submit/{id}', 'VendorController@bookingCancelSubmit')->name('bookingCancelSubmit');



            Route::post('/profile-update', 'VendorController@profileUpdate')->name('profileUpdate');

            Route::post('/profile-image-update', 'VendorController@profileImageUpdate')->name('profileImageUpdate');

            Route::get('/download/{id}', 'VendorController@downloadZip')->name('downloadZip');


            // Booking Section
            Route::post('/venue-booking-filter', 'VendorBookingController@bookingFilter')->name('bookingFilter');

            Route::post('/venue-booking', 'VendorBookingController@bookingStore')->name('bookingStore');


            //application

            Route::group([
                'prefix' => 'application',
                'as' => 'application.'
            ], function () {
                Route::get('/{id?}/{notificationid?}', 'ApplicationController@application')->name('index');

                Route::post('store', 'ApplicationController@applicationStore')->name('store');

                Route::get('proceed-to-payment/{id?}/{notificationid?}', 'ApplicationController@proceedToPayment')->name('proceedToPayment');
            });


            Route::group([
                'prefix' => 'payment',
                'as' => 'payment.'
            ], function () {

                Route::post('store/{id}', 'PaymentController@store')->name('store');
            });
        });
    }
);
