<?php

namespace App\Http\Controllers;

use App\Reason;
use App\User;
use App\ReasonToBook;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

define('DEFAULT_REASON', 'other');

class UsersController extends Controller
{

    /**
     *
     *FIXME::
     * [ ] Fix the users roster file
     *      [ ] Needs to allow the roster to add more than one user
     * [ ] Add a btn to the user to make them inactive or active
     *      [ ] Remove all the relations between users.
     *
     *
     *
     * */
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
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get all the reasons to display
        $reasons = Reason::all();
        //Show the form to insert users
        return view('admin.users.create')->with('reasons', $reasons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         *TODO
         *  Edge case
         *      [x] If the user already exists but the reason doesn't
         *      [x] If the user and the reason already exists
         *      [x] If the reason exits but the user doesn't
         *  Password Protection
         *      [x] Store a random string hashed for each user.
         *      [x] The user will then update that password.
         *      [x] Override the old password with their new one.
         *  Student Number
         *      [ ] Use a regex for the number
         *          [ ] Check if it has a #
         *          [ ] Check if the stdn has more than it should
         * */
        //User instance
        $user = new User();
        $users = [];
        //Reason model
        $reason = new Reason();

        //Reason relations User
        //Reason relations User for the default
        $reason_to_book_default = new ReasonToBook();

        /***********************************
         * CHECK IF THE ADMIN HAS A ROSTER FILE*
         * *********************************/
        if (isset($request->roster)) {
            $filename = $request->roster;
            //Get the array with data
            $data = parseFile($filename);
            //Get the data for the user
            $userData = $data['users'];
            //Get the data for the reason
            $reasonData = $data['reason'];
            $users = [];

            //Create the user from the roster.
            foreach ($userData as $myUser) {
                $user = new User;
                $user->createUser($myUser);

                //Override the request with the data from the file
                $request->merge([
                    'name' => $user->name,
                    'email' => $user->email,
                    'stdn' => $user->stdn,
                ])->validate([
                    'name' => 'required|min:2|max:255',
                    'email' => 'required|email',
                    'stdn' => 'required|min:7|max:255',
                ]);

                array_push($users, $user);
            }
            //Check if the reason already exists
            if ($reason->isUnique($reasonData)) {
                //Create the reason
                $reason->createReason($reasonData);
            } else {
                //Get the existing reason
                $reason = Reason::where('title', $reasonData)->first();
            }

        } else {  /*======== END OF THE ROSTER =============*/

            /****************************************************************                                                             *
             *          ADMIN ENTERS THE USER MANUALLY                     *
             ***************************************************************/

            //Only check if they are not admin
            $stdnRule = $request->admin ? 'unique:users|max:7' : 'required|unique:users|min:7|max:255';

            $rules = [
                'name' => 'required|min:2|max:255',
                'email' => 'unique:users|required|email|min:3|max:255',
                'stdn' => $stdnRule
            ];
            $request->validate($rules);
            $user->createUser($request);            //Create the new user.

            /*
             * If the user is an admin then the reason part is skiped
             * because the admin doesn't need reasons to be in the system.
             * */
            //Check if the user is an admin
            if ($request->admin) {
                //Set the admin status to true
                $user->admin = $request->admin;
                $user->save();
                Session::flash('success', 'Admin created successfully');
                return redirect()->route('users.show', $user->id);
            }

            //Push the user
            array_push($users, $user);
            //Check if the reason is set to something other then the default.
            if (strcmp($request->title, DEFAULT_REASON) < 0) {
                //Get the reason if exists.
                $reason = Reason::where('title', $request->reasons)->first();
            }
        }

        /**********************************************
         * ADDING THE USER AND REASON TO THE DATABASE *
         **********************************************/

        /*=====================Create the user=======================*/
        foreach ($users as $user) {
            $reason_to_book = new ReasonToBook();
            $reason_to_book_default = new ReasonToBook();

            //Check if the user does not exist
            if ($user->isUnique($user->email)) {
                //Generate a random token for later verification of the user
                $user->token = str_random(25);
                //Save the user
                $user->save();
                //Send the user an email
                /*FIXME:: The repetition of email will throw errors maybe fixable with other providers*/
                $user->sendVerificationEmail();
            } else {
                //get the existing user.
                $user = User::where('email', $user->email)->first();
            }

            /*===========================END OF CREATING THE USER====================*/

            /*============RELATION CREATION============*/
            if (!$user->isAdmin()) {        //Check if the user is not an admin so it can have reasons.
                if ($reason->isUnique($reason->title)) {            //check if the reason doesn't exists
                    $reason->save();
                }

                //Check if the relation doesn't exist yet
                if ($reason_to_book_default->isUnique($user->id, Reason::where('title', 'other')->pluck('id')->first())) {
                    //Add the default other to the user
                    $reason_to_book_default->createRelation($user, Reason::where('title', 'other')->first());
                    //Save the relation between the user and the reason
                    $reason_to_book_default->save();
                }

                //Check if the relation already exists
                if ($reason_to_book->isUnique($user->id, $reason->where('title', $reason->title)->pluck('id')->first())) {
                    //Create the instance of the reason to book
                    $reason_to_book->createRelation($user, $reason->where('title', $reason->title)->first());
                    //Create the relation between the user and the reason.
                    $reason_to_book->save();
                }
            }
        }
        /*==========END OF THE RELATION CREATION==========*/
        Session::flash('success', 'Users successfully created');        //Save the message in the session
        return redirect(route('users.index'));        //Redirect the admin to the show user
        /*==========END OF THE USER NOTIFICATION==========*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show(User $user)
    {
        //Use a join to select the relation and the reason.
        $reasons = $user->reasons();
        return view('admin.users.show')->with('user', $user)->with('reasons', $reasons);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit(User $user)
    {
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, User $user)
    {

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
        $user->home_address = $request->home_address;
        $user->phone_number = $request->phone_number;

        //Check if the user will be an admin
        if ($request->admin) {
            $user->admin = 1;
        }

        //Save the user
        $user->save();

        Session::flash('success', 'Successfully updated the user');
        return redirect(route('users.show', $user->id));
    }


    public
    function deactivate($id)
    {
        ReasonToBook::where('user_id', $id)->update(['active' => 0]);
        Session::flash('success', 'User successfully deactivated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     *
     * Remove the destroy route from the user
     * or redirect the user to somee error page
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
//        return redirect(route('errors.notAuthorized'));
    }

    public
    function search(Request $request)
    {

        if (empty($request->search)) {
            return view('admin.users.index')->with('users', User::orderBy('created_at', 'desc')->paginate(10));
        }

        $users = User::orderBy('created_at', 'desc')->where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')->paginate(10);

        return view('admin.users.index')->with('users', $users);

    }
}
