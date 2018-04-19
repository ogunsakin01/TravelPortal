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


Route::get('flight/search_results', function () {
    return view('pages.flight.search_result');
});

Route::get('flight/itinerary_booking', function () {
    return view('pages.flight.itinerary_booking');
});

Route::get('flight/payment_option', function () {
    return view('pages.flight.payment_option');
});

Route::get('flight/payment_confirmation', function () {
    return view('pages.flight.payment_confirmation');
});

Route::get('hotel/search_results', function () {
    return view('pages.hotel.search_result');
});
Route::get('hotel/hotel_details', function () {
    return view('pages.hotel.hotel_details');
});
Route::get('hotel/hotel_room_details', function () {
    return view('pages.hotel.hotel_room_details');
});
Route::get('hotel/hotel_booking', function () {
    return view('pages.hotel.hotel_booking');
});
Route::get('hotel/hotel_payment_option', function () {
    return view('pages.hotel.hotel_payment_option');
});
Route::get('hotel/hotel_payment_confirmation', function () {
    return view('pages.hotel.hotel_payment_confirmation');
});

Route::get('package/package_list', function () {
    return view('pages.package/package_list');
});
Route::get('package/package_details', function () {
    return view('pages.package/package_details');
});
Route::get('package/package_payment_option', function () {
    return view('pages.package/package_payment_option');
});
Route::get('package/package_payment_confirmation', function () {
    return view('pages.package/package_payment_confirmation');
});

Route::get('booking/flight/my_bookings', function () {
    return view('pages/booking/flight/my_bookings');
});
Route::get('booking/flight/agent_bookings', function () {
    return view('pages/booking/flight/agent_bookings');
});
Route::get('booking/flight/customer_bookings', function () {
    return view('pages/booking/flight/customer_bookings');
});

Route::get('booking/hotel/my_bookings', function () {
    return view('pages/booking/hotel/my_bookings');
});
Route::get('booking/hotel/agent_bookings', function () {
    return view('pages/booking/hotel/agent_bookings');
});
Route::get('booking/hotel/customer_bookings', function () {
    return view('pages/booking/hotel/customer_bookings');
});

Route::get('booking/package/my_bookings', function () {
    return view('pages/booking/package/my_bookings');
});
Route::get('booking/package/agent_bookings', function () {
    return view('pages/booking/package/agent_bookings');
});
Route::get('booking/package/customer_bookings', function () {
    return view('pages/booking/package/customer_bookings');
});

Route::get('setting/travel-package', function () {
    return view('pages/setting/travel-package/all_travel_packages');
});
Route::get('setting/travel-package/create', function () {
    return view('pages/setting/travel-package/create_package');
});
Route::get('setting/travel-package/categories', function () {
    return view('pages/setting/travel-package/categories');
});

Route::get('setting/other-setting/profile_management', function () {
    return view('pages/setting/other-setting/profile_management');
});
Route::get('setting/other-setting/Wallet_management', function () {
    return view('pages/setting/other-setting/Wallet_management');
});
Route::get('setting/other-setting/Customer_bookings', function () {
    return view('pages/setting/other-setting/Customer_bookings');
});

Route::get('typeaheadJs', 'AirportController@typeAhead')->name('typeaheadJs');
Route::get('airlineTypeAheadJs', 'AirlineController@typeAhead')->name('airlineTypeAheadJs');



Route::post('/one-way-flight-search','FlightController@oneWayFlightSearch');
Route::post('/round-trip-flight-search','FlightController@roundTripFlightSearch');
Route::post('/multi-destination-flight-search','FlightController@multiDestinationFlightSearch');
Route::get('/selected-itinerary-info/{id}','FlightController@selectedItineraryInfo');
Route::get('/get-flight-information-and-pricing/{id}','FlightController@getItineraryInformationAndPricing');


Route::get('/itinerary-booking','ViewController@itineraryBooking');
Route::get('/available-itineraries','ViewController@availableItineraries');


Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard')->name('dashboard');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout','Auth\LoginController@logout');
