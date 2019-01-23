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

//The main index routs
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function(){
    //The dashboard
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
    Route::resource('users', 'UsersController');
});



//Authentication routes
Auth::routes();

Route::prefix('auth')->group(function(){
    Route::get('verifyAccount/{token}', 'VerifyAccount@verifyAccount')->name('auth.verifyAccount');
    Route::get('verifyAccount/{id}/edit', 'VerifyAccount@update')->name('auth.update');
});

Route::get('auth/completeRegistration/{id}', 'VerifyAccount@completeRegistration')->name('auth.finishRegister');
//The dashboard
Route::get('/home', 'PagesController@index')->name('home');
