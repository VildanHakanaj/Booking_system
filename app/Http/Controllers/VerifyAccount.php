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
        $user->token = null;
        $user->save();

        return view('auth.completeRegistration')->with('user', $user);
    }

    public function update(User $user){
        dd($user);
    }
}
