<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Reason;
use App\ReasonToBook;

class ReasonsToBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::where('id', $id)->first();
        $reasons = Reason::all();
        return view('admin.reasonToBook.create')->with('user', $user)->with('reasons', $reasons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reasonToBook = new ReasonToBook();
        $request->validate(
            [
                'user_id' => 'required',
                'reason_id' => 'required'
            ]
        );


        if(!ReasonToBook::where('id', 12)->where('reason_id', $request->reason)->first()){
            $reasonToBook->create($request->all());
        }

        return redirect()->route('users.show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
