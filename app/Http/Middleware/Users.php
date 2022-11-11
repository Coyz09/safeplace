<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Users
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
    
            if(Auth::guard('web')->user()->isUser())
            {
                return $next($request);
            }
            else{
                return redirect()->back()->with('error',"You do not have access!"); 
            }
    //    }
    
       
    }
}