<?php

namespace App\Http\Controllers;

use App\Reason;
use App\User;
use App\ReasonToBook;
use Illuminate\Http\Request;
use Session;

define('DEFAULT_REASON', 'other');
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
        //Get all the reasons
        $reasons = Reason::all();

        //Show the form to insert users
        return view('admin.users.create' )->with( 'reasons', $reasons );
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
         *TODO
         *  Edge case
         *      [ ] If the user already exists but the reason doesn't
         *      [ ] If the user and the reason already exists
         *      [ ] If the reason exits but the user doesn't
         *  Password Protection
         *      [ ] Store a random string hashed for each user.
         *      [ ] The user will then update that password.
         *      [ ] Override the old password with their new one.
         *  Student Number
         *      [ ] Use a regex for the number
         *          [ ] Check if it has a #
         *          [ ] Check if the stdn has more than it should
         * */
        $user                   = new User();               //User instance

        $reason                 = new Reason();             //Reason model

        $reason_to_book         = new ReasonToBook();       //Reason relations User

        $reason_to_book_default = new ReasonToBook();       //Reason relations User for the default


        /*==================== CHECK IF WE HAVE ROSTER ====================*/
        if(isset($request->roster)){
            $data           = $user->parseFile();       //Get the array with data
            $userData       =   $data[0];               //Get the data for the user
            $reasonData     =   $data[1];               //Get the data for the reason

            $user->createUser($userData);               //Create the user from the roster.
            $request->merge([                           //Override the request with the data from the file
                'name'  => $user->name,
                'email' => $user->email,
                'stdn'  => $user->stdn,
            ]);

            $request->validate([                        //Validate the file data for user
                'name'  => 'required|min:2|max:255',
                'email' => 'required|email',
                'stdn'  => 'required|min:7|max:255',
            ]);

            if($reason->isUnique($reasonData['reason'])){               //Check if the reason already exists
                $reason->createReason($reasonData);                     //Create the reason
            }else{
                $reason = Reason::where('title', $reasonData['reason'])->first();                //Get the existing reason
            }

        }else{  /*======== END OF THE ROSTER =============*/

            /*==================== VALIDATE AND CREATE THE USER MANUALLY ==================== */
            $request->validate([                        //Validate the request for the user
                'name'      => 'min:3|max:255',
                'email'     => 'required|email|min:3|max:255',
                'stdn'      => 'required|min:7|max:255',
            ]);

            $user->createUser($request);            //Create the new user.

            if(strcmp($request->title, DEFAULT_REASON) < 0){                        //Check if the reason is set to something other then the default.

                $reason = Reason::where('title', $request->reasons)->first();            //Get the reason if exists.

            }
        }


        /**********************************************
         * ADDING THE USER AND REASON TO THE DATABASE *
         **********************************************/

        /*=====================Create the user=======================*/
        if($request->admin){        //Check if the user is an admin
            $user->admin = $request->admin;            //Set the admin status to true
        }

        $user->token = str_random(25);        //Generate a random token for later verification of the user

        //Check if the user does not exist
        if($user->isUnique($user->email)){
            $user->save();        //Save the user
            $user->sendVerificationEmail();        //Send the user an email
        }else{
            //get the existing user.
            $user = User::where('email', $user->email)->first();
        }
        /*===========================END OF CREATING THE USER====================*/

        /*============RELATION CREATION============*/

        if(!$user->isAdmin()){        //Check if the user is not an admin so it can have reasons.

            if($reason->isUnique($reason->title)){            //check if the reason doesn't exists
                $reason->save();

            }

            //Check if the relation doesn't exist yet
            if($reason_to_book_default->isUnique($user->id, Reason::where('title', 'Other')->pluck('id'))){
                $reason_to_book_default->createRelation($user, Reason::where('title', 'Other')->first());        //Add the default other to the user
                $user->reasons()->save($reason_to_book_default);            //Save the relation between the user and the reason
            }

            //Check if the relation already exists
            if($reason_to_book->isUnique($user->id, $reason->where('title', $reason->title)->pluck('id')->first())){
                $reason_to_book->createRelation($user, $reason->where('title', $reason->title)->first());                //Create the instance of the reason to book
                $user->reasons()->save($reason_to_book);                //Create the relation between the user and the reason.
            }
        }
        /*==========END OF THE RELATION CREATION==========*/

        Session::flash('success', 'User successfully created');        //Save the message in the session

        return redirect(route('users.show', $user->id));        //Redirect the admin to the show user
        /*==========END OF THE USER NOTIFICATION==========*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $reasons = array();
        foreach($user->reasons as $reason){
            if($reason->active == 1){
                $reasons[] = Reason::find($reason->reason_id);
            }
        }

        return view('admin.users.show')->with('user', $user)->with('reasons', $reasons);

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
     *
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
