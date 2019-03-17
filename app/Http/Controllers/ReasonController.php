<?php

namespace App\Http\Controllers;

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
        //validate the request
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'min:2|max:255',
            'expires_at' => 'date',
        ]);

        $reason->title = $request->title;
        $reason->description = $request->description;
        $reason->expires_at = $request->expires_at;

        $reason->save();

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
        //
    }

    public function search(Request $request){

        if(empty($request->search)){
            return view('admin.reasons.index')->with('reasons', Reason::orderBy('created_at', 'desc')->paginate(10));
        }

        $reasons = Reason::orderBy('created_at', 'desc')->where('title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('title', 'LIKE', '%' . $request->search . '%')
            ->paginate(10);
        return view('admin.reasons.index')->with('reasons', $reasons);

    }
}
