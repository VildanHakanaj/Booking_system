<?php

namespace App\Http\Controllers;

use App\Reason;
use App\User;
use App\ReasonToBook;
use Illuminate\Http\Request;
use Session;

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
        //Paginate the user by 10
        $users = User::paginate(10);
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
        //User instance
        $user = new User();

        //Reason model
        $reason = new Reason();

        //Reason relations User
        $reasonRel = new ReasonToBook();

        /*
         *
         *TODO
         * Parsing the file
         * [x] Write the method to Parse the file
         *      [x] Create a user request
         *      [x] Validate the request
         * [x] Create a reasons instance
         * Before the user is registered
         * [x] Find a way to see if the reason is a full year or just a half semester
         * If the its a full year
         *      [x] Set the expiry date to the end of the school year.
         *      [x] what if the user is registered in the winter time and has to do the full year
         * If its half a semester
         *      [x] set the expiry date based on the current date to the future date of the semesters finish.
         * After everything is done
         * [x] Validate the reason to book
         * [ ] Create the relation to the user
         *      [ ] This can be accomplished with the laravel relationship
         * ASSUMPTION
         * [ ] The admin will never add duplicate users.
         * */


        //Check if the roster is passed
        if(!empty($request->roster)){

            //Get the array with data
            $data           = $user->parseFile();

            //Get both of the data for the user and the reason
            $userData       =   $data[0];
            $reasonData     =   $data[1];

            //Get the user data
            $user->createUser($userData);

            //Check if the reason doesn't exist already.
            if(!$reason->where('title', $reasonData['reason'])->first()){

                $reason->createReason($reasonData);
                $reason->save();

            }


        }else{  //Check the inputs submitted

            //Validate the request
            $request->validate([

                'name'      => 'min:3|max:255',
                'email'     => 'required|unique:users|email|min:3|max:255',
                'stdn'      => 'required|unique:users|min:7|max:255',

            ]);

            //Create the new user.
            $user->createUser($request);

            //If the user is not an admin
            if(!$request->admin){
                //Validate the Reason input
                $request->validate([
                    'title'         => 'required|unique:reasons|max:255',
                    'description'   => 'required|min:7|max:255',
                    'expires_at'    => 'required||min:7|max:255|date'
                ]);

                //Create the reason model
                $request->createReason($request);
                $reason->save();

                //Add the relation between user an reason
                $reasonRel->createRelation($user, $reason);
            }
        }

        //Check if the user is an admin
        if($request->admin){
            $user->admin = $request->admin;
        }

        //Generate a random token
        $user->token = str_random(25);

        //Check if the user exists.
        if($user->where('email', $user->email)->first()){

            Session::flash('error', 'The user already exists');
            return redirect()->back();

        }

        //Save the user
        $user->save();

        $reasonRel->createRelation( $user, $reason );
        $reasonRel->save();

        //Send the user an email
        $user->sendVerificationEmail();

        //Save the message in the session
        Session::flash('success', 'User successfully created');

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
         *
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

        //Save the user
        $user->save();


        Session::flash('success', 'Successfully updated the user');
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
