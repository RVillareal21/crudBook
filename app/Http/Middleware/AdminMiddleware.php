<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->user_role == 1){
                return $next($request);
            } else {
                return redirect('/home')->with('message', 'You are not authorized to access this page.');
            }
        } else {
            return redirect('/login')->with('message', 'Log in to access the site.');
        }
        return $next($request);
    }
}
