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
 * [x] Create the products table
 * [ ] Create the factory for the products table
 * [x] Run the migrations and seeds for the database
 * [x] Create the layout of the products
 * [x] Create the CRUD pages for the products
 * [ ] Create the search engine for available products
 * QUESTION
 * [ ] Since the user will always have the other category will they ever have no permission to book.
 * **NOTE**
 * FOR THIS TASK TAKE A LOOK AT THE NOTEBOOK FROM THE FIRST MEETING
 * ALSO LOOK AT THE CALENDAR THEY ALREADY USE TO SEE WHAT KIND OF CAMERA THEY HAVE
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
