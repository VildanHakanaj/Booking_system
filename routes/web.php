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
/*
 *
 *TODO
 * [x] Need to sort all the controllers so that it will allow access to all
 * [x] Move the booking page to a seperate page
 * [x] Allow home page to have 3 options
 *      [x] Book by date
 *      [x] Check available dates for products
 *      [x] Allow the user to explore Explore kits
 *TODO
 * [x] Find a solution for the redirect problem
 * [x] Allow user to cancel the bookings
 * Admin Bookings
 * [x] Allow the admin to edit the bookings by pushing the date
 * [x] Allow the admin to cancel a booking
 * [ ] Notify the admin if the change of times will affect any of the bookings
 *      [ ] Send the admin a list of all the affected users from the date change so the admin can take actions
 * [ ] Allow admin to click on the email
 * [ ] Allow the admin to resend an authentication email
 *
 *
 *
 *FIXME::
 * [ ] Make all the controllers with in build middleware
 * [ ] See to split the big controller for the booking
 * [ ] Find a way to search the joined table
 *
 * */
//The main index path
Route::get('/', 'PagesController@index');
/*
 * All the routes will have a prefix of admin
 *
 * The user will need to be an administrator and to be authenticated
 * in order to user this paths
 * Hence the middleware admin and auth
 *
 * */
Route::prefix('admin')->middleware(['admin', 'auth'])->group(function () {
    //The dashboard
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');

    //Users pages resources
    Route::resource('users', 'UsersController');
    Route::get('users/deactivate/{user}', 'UsersController@deactivate')->name('users.deactivate');

    //Reasons pages resources
    Route::resource('reason', 'ReasonController');

    /*=====================ADMIN REASON TO BOOK ROUTES=====================*/
    Route::resource('reasonToBook', 'ReasonsToBookController');

    //To add the reason
    Route::get('reasonToBook/create/{id}', 'ReasonsToBookController@create')->name('reasonToBook.create');
    Route::get('reasonToBook/deactivate/{user}/{reason}', 'ReasonsToBookController@deactivate')->name('reasonToBook.deactivate');

    /*=======================ADMIN PRODUCTS ROUTES===========================*/
    Route::resource('products', 'ProductController');

    /*=========================ADMIN KITS ROUTES===============================*/
    Route::resource('kits', 'KitController');
    Route::post('kits/checkProduct/{kit}', 'KitController@checkProduct')->name('kitProduct.checkProduct');

    /*-------------------------ADMIN KitProduct ROUTES -------------------------*/
    Route::get('kitsProduct/create/{kit}', 'KitProductController@create')->name('kitProduct.create');
    Route::post('kitsProduct/store', 'KitProductController@store')->name('kitProduct.store');
    Route::get('kitsProduct/removeProduct/{product}', 'KitProductController@removeProduct')->name('kitProduct.removeProduct');
    Route::get('kitsProduct/removeAll/{kit}', 'KitProductController@removeAll')->name('kitProduct.removeAll');

    /*========================ADMIN SEARCH ROUTES==============================*/
    Route::post('users/search', 'UsersController@search')->name('users.search');
    Route::post('kits/search', 'KitController@search')->name('kits.search');
    Route::post('products/search', 'ProductController@search')->name('products.search');
    Route::post('reasons/search', 'ReasonController@search')->name('reasons.search');
    Route::post('bookings/search', 'BookingController@search')->name('bookings.search');

    /*========================ADMIN BOOKING ROUTES==============================*/
    Route::resource('bookings', 'BookingController');

    /*========================ADMIN SETTINGS ROUTES==============================*/
    Route::resource('bookingSettings', 'BookingSettingsController');
    Route::get('checkInTimes', 'CheckInTimesController@edit')->name('checkInTimes.edit');
    Route::post('checkInTimes', 'CheckInTimesController@store')->name('checkInTimes.store');

});

//Authentication routes
Auth::routes();

//Complete the registration for the user.
Route::prefix('auth')->group(function () {
    Route::get('verifyAccount/{token}', 'VerifyAccount@verifyAccount')->name('verify.verifyAccount');
    Route::Put('verifyAccount/{user}', 'VerifyAccount@update')->name('verify.update');
    Route::get('completeRegistration/{user}', 'VerifyAccount@completeRegistration')->name('verify.finishRegister');
});

// Not sure if i need this
//Route::get('/completeRegistration', function(){
//    return view('auth.verifyAccount.edit');
//});
//The dashboard
Route::get('/', 'PagesController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    /*
     * User booking controller only allows user to create a booking and delete one
     *
     * Doesn't allow the user to edit a booking view the complete list off bookings
     * */

    Route::resource('userBookings', 'UserBookingController')->except([
        'create', 'update', 'index', 'edit'
    ]);
    /*Kits public routes*/
    Route::get('/booking', 'PagesController@bookings')->name('booking');
    Route::get('/booking/explore', 'PagesController@exploreKits')->name('booking.exploreKits');
    Route::post('/kits/checkAvailability', 'KitController@checkAvailability')->name('kits.checkAvailability');

});
