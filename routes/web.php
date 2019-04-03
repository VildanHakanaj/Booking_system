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
 *TODO
 * [ ] Need to sort all the controllers so that it will allow access to all
 * */
//The main index path
Route::get('/', 'PagesController@index');

//Administrator paths
Route::prefix('admin')->middleware(['admin', 'auth'])->group(function () {
    //The dashboard
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');

    //Users pages resources
    Route::resource('users', 'UsersController');
    Route::get('users/deactivate/{id}', 'UsersController@deactivate')->name('users.deactivate');

    //Reasons pages resources
    Route::resource('reason', 'ReasonController');

    /*=====================REASON TO BOOK ROUTES=====================*/
    Route::resource('reasonToBook', 'ReasonsToBookController');
    //To add the reason
    Route::get('reasonToBook/create/{id}', 'ReasonsToBookController@create')->name('reasonToBook.create');
    Route::get('reasonToBook/deactivate/{user}/{reason}', 'ReasonsToBookController@deactivate')->name('reasonToBook.deactivate');

    /*=======================PRODUCTS ROUTES===========================*/
    Route::resource('products', 'ProductController');

    /*=========================KITS ROUTES===============================*/
    Route::resource('kits', 'KitController');
    Route::post('kits/checkProduct/{kit}', 'KitController@checkProduct')->name('kitProduct.checkProduct');
    /*-------------------------KitProduct ROUTES -------------------------*/
    Route::get('kitsProduct/create/{kit}', 'KitProductController@create')->name('kitProduct.create');
    Route::post('kitsProduct/store', 'KitProductController@store')->name('kitProduct.store');
    Route::get('kitsProduct/removeProduct/{product}', 'KitProductController@removeProduct')->name('kitProduct.removeProduct');
    Route::get('kitsProduct/removeAll/{kit}', 'KitProductController@removeAll')->name('kitProduct.removeAll');

    /*========================SEARCH ROUTES==============================*/
    Route::post('users/search', 'UsersController@search')->name('users.search');
    Route::post('kits/search', 'KitController@search')->name('kits.search');
    Route::post('products/search', 'ProductController@search')->name('products.search');
    Route::post('reasons/search', 'ReasonController@search')->name('reasons.search');
    Route::post('bookings/search', 'BookingController@search')->name('bookings.search');
    /*========================BOOKING ROUTES==============================*/
    Route::resource('bookings', 'BookingController');
    /*========================SETTINGS ROUTES==============================*/
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
Route::get('/index', 'PagesController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    /*Kits public routes*/
    Route::post('/kits/checkAvailability', 'KitController@checkAvailability')->name('kits.checkAvailability');

});
