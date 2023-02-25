<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
    //    if (!Auth::guard('web')->check())
    //    {
        $user = Auth::guard('web')->user();
            if(Auth::guard('web')->user()->isAdmin())
            {
                // dd($user->role); 
                return $next($request);
            }
    //    }
    
    //    return redirect()->route('user.signin')->with('error',"Please Login!");
    }
}
