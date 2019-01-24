<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class VerifyAccount extends Controller
{
    public function __construct()
    {
    }

    public function verifyAccount($token){

        $user = User::where('token', $token)->firstOrFail();
//        $user->token = null;
//        $user->save();
        return view('auth.verifyAccount.edit')->with('user', $user);
    }

    public function update(Request $request, User $user){

        $request->validate([
            'home_address'  => 'required|min:3|max:255',
            'phone_number'  => 'required|min:7|max:255',
            'password'      => 'required|min:7|max:255|confirmed'
        ]);

        //If the validation works
        $user->update([
            'home_address' => $request->home_address,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
        ]);

        $user->token = null;
        $user->save();
        return redirect(route('login'));
    }
}
