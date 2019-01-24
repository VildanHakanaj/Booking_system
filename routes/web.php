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


//The main index path
Route::get('/', function () {
    return view('welcome');
});

//Administrator paths
Route::prefix('admin')->group(function(){

    //The dashboard
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');

    //Users pages resources
    Route::resource('users', 'UsersController');

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
Route::get('/home', 'PagesController@index')->name('home');
