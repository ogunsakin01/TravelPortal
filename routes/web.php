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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout','Auth\LoginController@logout');
Route::post('/custom-sign-in','UserController@signIn');
Route::post('/custom-sign-up','UserController@signUp');

Route::get('typeaheadJs', 'AirportController@typeAhead')->name('typeaheadJs');
Route::get('airlineTypeAheadJs', 'AirlineController@typeAhead')->name('airlineTypeAheadJs');

Route::post('/one-way-flight-search','FlightController@oneWayFlightSearch');
Route::post('/round-trip-flight-search','FlightController@roundTripFlightSearch');
Route::post('/multi-destination-flight-search','FlightController@multiDestinationFlightSearch');
Route::get('/selected-itinerary-info/{id}','FlightController@selectedItineraryInfo');
Route::get('/get-flight-information-and-pricing/{id}','FlightController@getItineraryInformationAndPricing');
Route::post('/book-itinerary','FlightController@bookItinerary');
Route::post('/bank-payment','BankPaymentController@itineraryBankPayment');
Route::get('/itinerary-booking','ViewController@itineraryBooking');
Route::get('/available-itineraries','ViewController@availableItineraries');
Route::get('/flight-booking-payment-page','ViewController@flightBookingPayment');
Route::get('/flight-booking-confirmation','ViewController@flightPaymentConfirmation');

Route::get('/cancel-pnr/{pnr}','FlightController@cancelPNR');
Route::get('/issue-ticket/{pnr}','FlightController@issueTicket');
Route::get('/void-ticket/{pnr}','FlightController@voidTicket');

Route::post('/generate-interswitch-payment','OnlinePaymentController@generateInterswitchPayment');
Route::post('/interswitch-payment-verification','OnlinePaymentController@interswitchPaymentVerification');
Route::post('/generate-paystack-payment','OnlinePaymentController@generatePayStackPayment');
Route::get('/paystack-payment-verification','OnlinePaymentController@payStackPaymentVerification');

Route::post('backend/generate-interswitch-payment','OnlinePaymentController@generateInterswitchPaymentBackEnd');
Route::post('backend/interswitch-payment-verification','OnlinePaymentController@interswitchPaymentVerificationBackEnd');
Route::post('backend/generate-paystack-payment','OnlinePaymentController@generatePayStackPaymentBackEnd');
Route::get('backend/paystack-payment-verification','OnlinePaymentController@payStackPaymentVerificationBackEnd');

Route::get('backend/payment-confirmation','BackEndViewController@paymentConfirmation');

Route::post('/searchHotel','HotelController@searchHotel');
Route::get('/available-hotels','ViewController@availableHotels');

Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard','BackEndViewController@dashboard')->name('dashboard');

    Route::group(['prefix' => 'settings'],function(){

        Route::get('vats','BackEndViewController@vat')->name('vats');
        Route::post('vat', 'VatController@saveVat')->name('backend-save-vat');
        Route::get('getVat/{type}','VatController@getVat');

        Route::get('markups', 'BackEndViewController@markupView');
        Route::post('markup/admin', 'MarkupController@saveAdminMarkup')->name('backend-save-markup');
        Route::get('getMarkup/{id}','MarkupController@getMarkupById');

        Route::get('markdown', 'BackEndViewController@index');
        Route::post('createOrUpdateMarkdown','MarkdownController@createOrUpdate');
        Route::get('getMarkdown/{id}','MarkdownController@getMarkdownById');

        Route::group(['prefix' => 'bank-details'],function(){
            Route::get('/fetch/{id}', 'BankDetailController@getBankDetail')->name('backend-bank-details');
            Route::view('','pages.backend.settings.banks')->name('banks');
            Route::post('/saveOrUpdate','BankDetailController@saveOrUpdateBankDetails');
            Route::post('/activate','BankDetailController@activateBankDetails');
            Route::post('/deActivate','BankDetailController@deActivateBankDetails');
            Route::post('/delete','BankDetailController@deleteBankDetails');
        });

        Route::get('/profile', 'BackEndViewController@profile')->name('profile');
        Route::get('', 'ProfileController@profileView')->name('backend-profile-view');

        Route::group(['prefix' => 'users'],function(){
            Route::get('/', 'UserController@index');
        });

    });

    Route::group(['prefix' => 'bookings'],function(){

        Route::group(['prefix' => 'flight'],function(){
           Route::get('user','BackEndViewController@userFlightBookings');
           Route::get('agent','BackEndViewController@agentFlightBookings');
           Route::get('customer','BackEndViewController@customerFlightBookings');
           Route::get('itinerary-booking-information/{reference}','BackEndViewCOntroller@itineraryBookingInformation');

        });

        Route::group(['prefix' => 'hotel'],function(){
            Route::get('user','BackEndViewController@userHotelBookings');
            Route::get('agent','BackEndViewController@agentHotelBookings');
            Route::get('customer','BackEndViewController@customerHotelBookings');
        });

    });

    Route::group(['prefix' => 'transactions'],function(){

    });

    Route::group(['prefix' => 'travel-packages'],function(){

    });

    Route::group(['prefix' => 'wallets'],function(){

    });

});

Auth::routes();


