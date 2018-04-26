<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
     $request->user();
});

Route::group(['prefix' => 'v1'],function(){

    Route::group(['prefix' => 'auth'],function(){
        Route::post('register','authAPIController@register');
        Route::post('login','authAPIController@login');
        Route::post('logout','authAPIController@logout');
    });

    Route::group(['middleware' => 'auth:api'],function(){

        Route::group(['prefix' => 'flight'],function(){

            Route::post('one-way','FlightAPIController@oneWaySearchV1');
            Route::post('round-trip','FlightAPIController@roundTripSearchV1');
            Route::post('multiple-destination','FlightAPIController@multiDestinationSearchV1');
            Route::post('price-itinerary','FlightAPIController@priceItineraryV1');
            Route::post('book-itinerary','FlightAPIController@bookItineraryV1');

            Route::get('all-bookings/{userId}','FlightAPIController@getAllBookingsV1');
            Route::get('get-booking/{pnr}','FlightAPIController@getFlightBookingV1');
            Route::get('payment-successful/{pnr}','FlightAPIController@paymentSuccessfulV1');
            Route::get('payment-pending/{pnr}','FlightAPIController@paymentPendingV1');

        });

        Route::group(['prefix' => 'hotel'],function(){

        });

    });
});


