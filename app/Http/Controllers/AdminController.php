<?php

namespace App\Http\Controllers;

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
        $userCount = \App\User::all()->count();
        return view('admin.dashboard', compact('userCount'));
    }
}
