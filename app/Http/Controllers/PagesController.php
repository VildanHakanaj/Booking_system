<?php

namespace App\Http\Controllers;

use App\Kit;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
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
        return view('pages.bookings.index')
                    ->with('kits', $kits);
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
