<?php

namespace App\Http\Controllers;

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

    public function contactUs(){
        return view('pages.contact');
    }

    public function booking(){
        return view('pages.booking');
    }
}
