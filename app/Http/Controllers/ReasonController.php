<?php

namespace App\Http\Controllers;

use App\Reason;
use Illuminate\Http\Request;

class ReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all the reasons
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Create a new Reason
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Store the new reason
        //Validate the reason
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function show(Reason $reason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function edit(Reason $reason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reason $reason)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reason $reason)
    {
        //
    }
}
