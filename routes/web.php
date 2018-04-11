<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

<<<<<<< HEAD
Route::get('flight/search_results', 'FlightController@flightSearchResult');
Route::get('flight/itinerary_booking', 'FlightController@flightItineraryBooking');
Route::get('flight/payment_option', 'FlightController@flightPaymentOption');
Route::get('flight/payment_confirmation', 'FlightController@flightPaymentConfirmation');

Route::get('hotel/search_results', 'HotelController@HotelSearchResult');
Route::get('hotel/hotel_booking', 'HotelController@hotelBooking');
Route::get('hotel/hotel_payment_option', 'HotelController@hotelPaymentOption');
Route::get('hotel/hotel_payment_confirmation', 'HotelController@hotelPaymentConfirmation');
Route::get('hotel/hotel_room_details', 'HotelController@roomDetails');
Route::get('hotel/hotel_details', 'HotelController@hotelDetails');

Route::get('package/package_details', 'PackageController@packageDetails');
Route::get('package/package_list', 'PackageController@packageList');
Route::get('package/package_payment_option', 'PackageController@packagePaymentOption');
Route::get('package/package_payment_confirmation', 'PackageController@packagePaymentConfirmation');

Route::get('pages/booking/flight/my_bookings', function () {
    return view('pages/booking/flight/my_bookings');
});

Route::get('pages/booking/flight/agent_bookings', function () {
    return view('pages/booking/flight/agent_bookings');
});

Route::get('pages/booking/flight/customer_bookings', function () {
    return view('pages/booking/flight/customer_bookings');
});

Route::get('pages/booking/package/my_bookings', function () {
    return view('pages/booking/package/my_bookings');
});

Route::get('pages/booking/package/agent_bookings', function () {
    return view('pages/booking/package/agent_bookings');
});

Route::get('pages/booking/package/customer_bookings', function () {
    return view('pages/booking/package/customer_bookings');
});
=======

Route::get('search_results', function () {
    return view('pages.flight.search_result');
});


Route::get('typeaheadJs', 'AirportController@typeAhead')->name('typeaheadJs');
Route::get('airlineTypeAheadJs', 'AirlineController@typeAhead')->name('airlineTypeAheadJs');



Route::post('/one-way-flight-search','FlightController@oneWayFlightSearch');
Route::post('/round-trip-flight-search','FlightController@roundTripFlightSearch');
Route::post('/multi-destination-flight-search','FlightController@multiDestinationFlightSearch');

Route::get('/available-itineraries','ViewController@availableItineraries');


>>>>>>> 8f8fc7e6ea4a2a61594d465d0b1e5d82f4639d59
