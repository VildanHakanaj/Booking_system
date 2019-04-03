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
        $kits = Kit::all();
        return view('pages.bookings.index')
                    ->with('kits', $kits);
    }

    public function contactUs(){
        return view('pages.contact');
    }

    public function booking(){
        return view('pages.booking');
    }
}
