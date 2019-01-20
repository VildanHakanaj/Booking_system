<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Check if the user logged in at all
        if(!$request->user()){
            //redirect to the login page
            return redirect('login');
        }
        //Check if the user is an administrator
        if($request->user()->admin == 1){
            return $next($request);
        }

        //Redirect to the index page
        return redirect('/');

    }
}
