<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Reason;
use App\User;
use App\ReasonToBook;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

define('DEFAULT_REASON', 'other');

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'admin.users.index',
            [
                'users' => User::latest()->paginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get all the reasons to display
        //Show the form to insert users
        return view(
            'admin.users.create',
            [
                'reasons' => Reason::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('roster')) {
            User::createUsersFromRoster($request, $request->roster);
        } else {
            $validated = $request->validate(
                [
                    'stdn' => 'required|min:7|unique:users',
                    'email' => 'required|email|unique:users',
                    'name' => 'required|min:2',
                ]
            );
            if ($request->has('admin')) {
                $validated['admin'] = $request->admin;
            }
            
            $user = User::create($validated);

            if (!$user->isAdmin()) {
                $user->addReasonForNewUser($request->reasons);
            }
        }
        return redirect(route('users.index'))
                ->with('success', 'Users successfully created');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view(
            'admin.users.show',
            [
                'user' => $user,
                'reasons' => $user->reasons()->get()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            [
                'user' => $user
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'stdn' => 'required|min:3|max:255',
            'email' => 'email|required|min:3|max:255',
            'home_addres' => 'min:3|max:255',
            'phone_number' => 'min:10|max:255',
        ]);

        $user->toggleAdmin($request->admin);
        $user->update($data);

        Session::flash('success', 'Successfully updated the user');
        return redirect(route('users.show', $user->id));
    }


    public function deactivate(User $user)
    {
        $user->deactivate();
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
    public function destroy($id)
    {
    }

    public function search(Request $request)
    {
        if (empty($request->search)) {
            return redirect()->route('users.index');
        }

        return view('admin.users.index')->with('users', User::search($request->search));
    }
}
