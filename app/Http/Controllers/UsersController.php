<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
         * [ ] Remove the self generating password
         * [ ] leave the password blank if the admin doesn't set one
         * [ ]
         * */
        //Get the request
        $request->validate([
            'name' => 'min:3|max:255',
            'email' => 'required|unique:users|email|min:3|max:255',
            'stdn' => 'required|unique:users|min:7|max:255'
        ]);

        //Check if the admin has entered a password for the user
        //or if it should be generated
        if($request->has('password') && !empty($request->password)){
            $password = trim($request->password);
        }else{
            //Random password generator
            $length = 10;
            $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i){
                $str .= $keyspace[random_int(0, $max)];
            }
            $password = $str;
        }


        //Log in the user
        $user = new user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->stdn = $request->stdn;
        $user->password = bcrypt($password);

        if($request->admin){
            $user->admin = $request->admin;
        }
        $user->save();

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

        //Check if the user wants to change the password
        if($request->has('password') && !empty($request->password)) {
            $request->validate([
                'password' => 'min:6|max:255|confirmed',
            ]);

            $password = bcrypt($request->password);
        }
        $request->validate([
            'name' => 'required|min:3|max:255',
            'stdn' => 'required|min:3|max:255',
            'email' => 'email|required|min:3|max:255',
            'home_addres' => 'min:3|max:255',
            'phone_number' => 'min:10|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->home_address= $request->home_address;
        $user->phone_number = $request->phone_number;
        $user->password = $password ?? '';

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
