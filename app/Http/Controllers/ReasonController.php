<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReasonRequest;
use App\Reason;
use Illuminate\Http\Request;
use Session;

class ReasonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'admin.reasons.index',
            [
                'reasons' => Reason::latest()->paginate(10)
            ]
        );
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
    public function store(ReasonRequest $request)
    {
        $data = $request->validated();
        $reason = Reason::create($data);

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
    public function update(ReasonRequest $request, Reason $reason)
    {
        //validate the request
        $data = $request->validated();
        $reason->update($data);
        Session::flash('success', "Reason was successfully updated");
        return redirect(route('reason.show', $reason->id));
    }

    /**
     * Remove the specified resource from storage.
     *[ ] Will not implement what i can implement with this might be to archive the data
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reason $reason)
    {
    }

    public function search(Request $request)
    {
        if (empty($request->search)) {
            return redirect()->route('reason.index');
        }
        
        return view(
            'admin.reasons.index',
            [
                'reasons' => Reason::search($request->search)
            ]
        );
    }
}
