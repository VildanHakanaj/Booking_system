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
 * [ ] Create the kits and product relation
 * [ ] Check out the one to many relation
 *
 * */
//The main index path
Route::get('/', 'PagesController@index');

//Administrator paths
Route::prefix('admin')->group(function(){
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
    Route::get('kits.addProduct', 'KitController@addProduct');

    /*========================SEARCH ROUTES==============================*/
    Route::post('users/search', 'UsersController@search')->name('users.search');
    Route::post('kits/search', 'KitController@search')->name('kits.search');
    Route::post('products/search', 'ProductController@search')->name('products.search');
    Route::post('reasons/search', 'ReasonController@search')->name('reasons.search');

});

//Authentication routes
Auth::routes();

//Complete the registration for the user.
Route::prefix('auth')->group(function(){
    Route::get('verifyAccount/{token}', 'VerifyAccount@verifyAccount')->name('verify.verifyAccount');
    Route::Put('verifyAccount/{user}', 'VerifyAccount@update')->name('verify.update');
    Route::get('completeRegistration/{user}', 'VerifyAccount@completeRegistration')->name('verify.finishRegister');
});

//
//Route::get('/completeRegistration', function(){
//    return view('auth.verifyAccount.edit');
//});
//The dashboard
Route::get('/index', 'PagesController@index')->name('home');
