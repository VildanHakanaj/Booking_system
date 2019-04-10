<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /*
     * Display the dashboard for the admin
     * */
    function dashboard(){

        $booking = new Booking();
        $todaysBookings = $booking->currentDayBookings();
        $upComingBookings = $booking->upComingBookings();
        $userCount = \App\User::all()->count();
        return view('admin.dashboard', compact('userCount', 'todaysBookings', 'upComingBookings'));
    }



}
