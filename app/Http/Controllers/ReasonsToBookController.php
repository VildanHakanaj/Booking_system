<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Reason;
use App\ReasonToBook;
use Session;

class ReasonsToBookController extends Controller
{
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reasonToBook = new ReasonToBook();

        $request->validate(        //Validate the reason to book
            [
                'user_id' => 'required',
                'reason_id' => 'required'
            ]
        );

        //Check if the reason doesnt exist first
        if (!ReasonToBook::where('user_id', $request->user_id)->where('reason_id', $request->reason_id)->first()) {
            $reasonToBook->create($request->all());            //Insert the reason
            Session::flash('success', 'Reason To book successfully added');
        }

        return redirect()->route('users.show', $request->user_id);        //Redirect back to the user show
    }

    /**
     * Active and deactivate the reason based on the
     *
     * */
    public function deactivate(User $user, Reason $reason)
    {
        $reason = ReasonToBook::where('user_id', $user->id)->where('reason_id', $reason->id)->first();
        $reason->toggleActive();
        return redirect()->back();
    }
}
