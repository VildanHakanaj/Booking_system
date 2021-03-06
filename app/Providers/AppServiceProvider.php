<?php

namespace App\Providers;

use App\Booking;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //This part will only kick in only if the blade template is recognized.
        view()->composer('layouts.partials.dashNav', function($view){

            $view->with('users', \App\User::all())
                ->with('reasons', \App\Reason::all())
                ->with('products', \App\Product::all())
                ->with('kits', \App\Kit::all())
                ->with('bookings', \App\Booking::all());

        });

        view()->composer('layouts.partials.previousBooking', function($view){

            $view->with('currentBookings', Booking::where('user_id', auth()->user()->id));

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
