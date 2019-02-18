<?php

namespace App\Http\Controllers;

use App\Reason;
use Illuminate\Http\Request;
use Session;

class ReasonController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reasons = Reason::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.reasons.index')->with('reasons', $reasons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.reasons.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'unique:reasons|required|min:2|max:255',
            'description'   => 'min:2|max:255',
            'expires_at'    => 'required|date',
        ]);

        $reason = Reason::create($request->all());
        Session::flash('success', "The reason was sucesfully created");
        return redirect(route('reason.show', $reason));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function show(Reason $reason)
    {
        return view('admin.reasons.show')->with('reason', $reason);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function edit(Reason $reason)
    {
        return view('admin.reasons.edit')->with('reason', $reason);
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
        dd("here");
        //validate the request
        $request->validate([
            'title' => 'required|unique:reasons|min:2|max:255',
            'description' => 'min:2|max:255|text',
            'expires_at' => 'date',
        ]);

        $reason->create($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *[ ] Will not implement what i can implement with this might be to archive the data
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reason $reason)
    {
        //
    }
}
