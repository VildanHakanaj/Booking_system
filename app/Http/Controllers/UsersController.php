<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
class UsersController extends Controller
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
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Show the form to insert users
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*
         *TODO::
         * [ x ] Look into the observer class and try to
         *
         *
         */
        //Validate the request
        $request->validate([
            'name' => 'min:3|max:255',
            'email' => 'required|unique:users|email|min:3|max:255',
            'stdn' => 'required|unique:users|min:7|max:255'
        ]);

        //Create a new user instance
        $user = new user();

        //Create the new user.
        $user->name = $request->name;
        $user->email = $request->email;
        $user->stdn = $request->stdn;

        //Generate a random token
        $user->token = str_random(25);

        //Check if the admin checkbox is checked
        if($request->admin){
            $user->admin = $request->admin;
        }

        //Save the user
        $user->save();

        //Send the user an email
        $user->sendVerificationEmail();

        //Save the message in the session
        Session::flash('sucess', 'Users successfully created');

        //Redirect the admin to the show user.
        return redirect(route('users.show', $user->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        /*
         * TODO
         *  Refactor the code for the user Builder
         * */

        //Validate the request
        $request->validate([
            'name' => 'required|min:3|max:255',
            'stdn' => 'required|min:3|max:255',
            'email' => 'email|required|min:3|max:255',
            'home_addres' => 'min:3|max:255',
            'phone_number' => 'min:10|max:255',
        ]);

        //Get all the request data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->home_address= $request->home_address;
        $user->phone_number = $request->phone_number;
        //Check if the user will be an admin
        if($request->admin){
            $user->admin = $request->admin;
        }

        $user->save();
        Session::flash('sucess', 'Successfully updated the user');
        return redirect(route('users.show', $user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * TODO
     * Remove the destroy route from the user
     * or redirect the user to somee error page
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        return redirect(route('errors.notAuthorized'));
    }
}
