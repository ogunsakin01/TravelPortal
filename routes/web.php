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

Route::get('/', 'ViewController@home');
Route::get('/home', 'ViewController@home')->name('home');
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
Route::post('/hotel-bank-payment','BankPaymentController@hotelBankPayment');
Route::post('/flight-wallet-payment','WalletController@itineraryWalletPayment');
Route::post('/hotel-wallet-payment','WalletController@hotelWalletPayment');

Route::get('/itinerary-booking','ViewController@itineraryBooking')->middleware('flight.search.param','flight.selected','flight.pricing.info');
Route::get('/available-itineraries','ViewController@availableItineraries')->middleware('flight');
Route::get('/flight-booking-payment-page','ViewController@flightBookingPayment')->middleware('flight.search.param','flight.selected','flight.pricing.info','pnr');
Route::get('/flight-booking-confirmation','ViewController@flightPaymentConfirmation')->middleware('flight.search.param','flight.selected','flight.pricing.info','payment.info');

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


Route::post('/searchHotel','HotelController@searchHotel');
Route::get('/available-hotels','ViewController@availableHotels')->middleware('hotel','hotel.search.param');
Route::get('/get-selected-hotel-information/{id}','HotelController@getSelectedHotelInformation');
Route::get('/get-selected-hotel-rooms-information/{id}','HotelController@getSelectHotelRoomsInformation');
Route::get('/hotel-information','ViewController@hotelInformation')->middleware('hotel.information');
Route::get('/get-selected-hotel-room-information/{id}','HotelController@getSelectedHotelRoomInformation');
Route::get('/selected-hotel-information','HotelController@selectedHotel');
Route::get('/hotel-room-information/{id}','HotelController@hotelRoomInformation');
Route::get('/hotel-room-booking/{id}','ViewController@hotelRoomBooking')->middleware('hotel.search.param');
Route::post('/hold-customer-hotel-booking-information','HotelController@holdCustomerHotelBookingInfo');
Route::get('/get-logged-in-user',function(){
    return App\User::findOrFail(auth()->user()->id)
        ->join('profiles','profiles.user_id','=','users.id')
        ->join('role_user','role_user.user_id','=','users.id')
        ->first();
});
Route::get('/hotel-booking-payment-page','ViewController@hotelBookingPaymentPage')->middleware('hotel.search.param','hotel.room.selected');
Route::get('/hotel-booking-confirmation','HotelController@hotelPaymentConfirmation');
Route::get('/hotel-booking-completion','ViewCOntroller@hotelBookingCompletion')->middleware('hotel.search.param','hotel.room.selected','payment.info');


Route::middleware(['auth'])->group(function(){

    Route::post('/search-portal','BackEndViewController@searchPortal');

    Route::get('backend/payment-confirmation','BackEndViewController@paymentConfirmation');

    Route::post('/backend/generate-interswitch-wallet-payment','OnlinePaymentController@generateInterswitchWalletPayment');

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

        Route::post('/updateProfile','ProfileController@updateProfileImageJs');
        Route::post('/update/user/profile','ProfileController@updateUserProfile')->name('update-profile');
        Route::post('/update/user/image','ProfileController@updateUserProfileImage')->name('update-profile-image');
        Route::post('/update/user/password','ProfileController@updateUserProfilePassword')->name('update-profile-password');

        Route::group(['prefix' => 'users'],function(){
            Route::get('/', 'BackEndViewController@usersManagement');
            Route::post('/add-new','UserController@addNew');
            Route::get('/delete-user/{id}','UserController@deleteUser');
            Route::post('/update-user','UserController@updateUser');
        });

        Route::group(['prefix' => 'wallets'],function(){

            Route::get('','BackEndViewController@walletsManagement');
            Route::post('/update-wallet','WalletController@updateWallet');
            Route::get('/user-wallet','BackEndViewController@userWallet');
        });

        Route::get('subscribers','BackEndViewController@emailSubscriptions');

        Route::get('visa-application-requests','BackEndViewController@visaApplicationRequests');

    });

    Route::group(['prefix' => 'bookings'],function(){

        Route::group(['prefix' => 'flight'],function(){
            Route::get('user','BackEndViewController@userFlightBookings');
            Route::get('agent','BackEndViewController@agentFlightBookings');
            Route::get('customer','BackEndViewController@customerFlightBookings');
            Route::get('itinerary-booking-information/{reference}','BackEndViewController@itineraryBookingInformation');
        });

        Route::group(['prefix' => 'hotel'],function(){
            Route::get('user','BackEndViewController@userHotelBookings');
            Route::get('agent','BackEndViewController@agentHotelBookings');
            Route::get('customer','BackEndViewController@customerHotelBookings');
            Route::get('hotel-reservation-information/{reference}','BackEndViewController@hotelBookingInformation');
            Route::get('rebook-hotel-room/{reference}','HotelController@reBookHotelRoom');
        });

        Route::group(['prefix' => 'package'],function(){
            Route::get('user','BackEndViewController@userPackageBookings');
            Route::get('agent','BackEndViewController@agentPackageBookings');
            Route::get('customer','BackEndViewController@customerPackageBookings');
            Route::get('package-reservation-information/{reference}','BackEndViewController@packageBookingInformation');
        });
    });

    Route::group(['prefix' => 'transactions'],function(){
        Route::get('/online-payment','BackEndViewController@onlinePayment');
        Route::get('/bank-payment','BackEndViewController@bankPayment');

        Route::get('/user/online-payment','BackEndViewController@userOnlinePayment');
        Route::get('/user/bank-payment','BackEndViewController@userBankPayment');

        Route::post('/update-payment-proof','BankPaymentController@updatePaymentProof');
        Route::get('/update-payment-status/{id}/{type}','BankPaymentController@updatePaymentStatus');
        Route::get('/requery/{id}','OnlinePaymentController@requery');
    });

    Route::group(['prefix' => 'backend/travel-packages', 'middleware' => ['auth','role:admin'] ], function(){

        Route::get('', 'TravelPackageController@travelPackages');
        Route::get('create', 'TravelPackageController@packageCreate');
        Route::post('createPackage','TravelPackageController@create');
        Route::post('createFlightDeal','TravelPackageController@createFlightDeal');
        Route::post('createHotelDeal','TravelPackageController@createHotelDeal');
        Route::post('createAttraction','TravelPackageController@createAttraction');
        Route::get('delete-sight-seeing/{id}','TravelPackageController@deleteSightSeeing');
        Route::get('activate/{id}', 'TravelPackageController@activate')->name('activate');
        Route::get('deactivate/{id}', 'TravelPackageController@deactivate')->name('deactivate');
        Route::get('delete/{id}', 'TravelPackageController@deletePackage');
        Route::get('edit/{id}', 'TravelPackageController@editPackage');
        Route::post('delete-image','TravelPackageController@deleteImage');
        Route::get('categories','TravelPackageController@categories');
        Route::post('activate/category','TravelPackageController@activateCategory');
        Route::post('deActivate/category','TravelPackageController@deActivateCategory');
        Route::post('categoryCreateOrUpdate','TravelPackageController@categoryCreateOrUpdate');
        Route::post('storeGalleryInfo','TravelPackageController@storeGalleryImages');

    });

});

Route::group(['prefix' => '/deals'],function(){

    Route::get('','ViewController@hotDeals');
    Route::get('flight','ViewController@flightDeals');
    Route::get('hotel','ViewController@hotelDeals');
    Route::get('attraction','ViewController@attractionDeals');
    Route::get('details/{id}','ViewController@dealDetails');
    Route::get('booking/{id}','ViewController@dealBooking');
    Route::post('booking','TravelPackageController@bookDeal');
    Route::get('payment-options','ViewController@dealPaymentOptions')->middleware('deals.booking.id');
    Route::get('booking-confirmation','ViewController@dealBookingConfirmation')->middleware('payment.info','deals.booking.id');
    Route::post('calculateBookingAmount','TravelPackageController@calculateBookingAmount');
    Route::post('wallet-payment','WalletController@dealWalletPayment');
    Route::post('bank-payment','BankPaymentController@dealBankPayment');

});

Auth::routes();


