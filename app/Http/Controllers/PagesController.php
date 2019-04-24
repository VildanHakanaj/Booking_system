<?php

namespace App\Http\Controllers;

use App\CheckInTimes;
use App\Kit;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        //User needs to be authenticated
        $this->middleware('auth');
    }

    public function index(){
        return view('pages.index');
    }

    /*
     * Show the booking station
     *
     * */
    public function bookings(){
        $kits = Kit::where('status', '=', 1)->get();
        $bookingTimes = CheckInTimes::all();
        return view('pages.bookings.index')
                    ->with('kits', $kits)
                    ->with('times', $bookingTimes);
    }

    /*
     * Show the kits and allow user to search.
     *
     * */
    public function exploreKits(){
        $kits = Kit::where('status', '=', 1)->paginate(10);
        return view('pages.bookings.exploreKits')->with('kits', $kits);
    }

    /*
     * Show the contact page
     * */
    public function contactUs(){
        return view('pages.contact');
    }

    public function booking(){
        return view('pages.booking');
    }
}
