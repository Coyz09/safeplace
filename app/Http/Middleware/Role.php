<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //  public function handle($request, Closure $next, ...$roles)
    // {
        
        
    //    if ($user = Auth::user())
    //     {
    //     foreach($roles as $role) {
    //         if($user->role == $role){
    //             return $next($request);
    //          }
    //          elseif($user->role != $role)
    //          {
    //               return redirect()->back()->with('error',"You do not have access!"); 
    //          }
    //         }
    //     }

    //     else{
    //         return redirect()->route('user.signin')->with('error',"Please Login!");
    //     }
    //     // return redirect()->back(); 
    //     return $next($request);
        
    // }

    public function handle($request, Closure $next, ... $roles)
{
    if (!Auth::guard('web')->check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
    return redirect()->route('user.signin')->with('error',"Please Login!");

    // $user = Auth::user();
    $user = Auth::guard('web')->user();

    // if( $user->isAdmin()){
    //     return $next($request);
    // }

    // elseif( $user->isSuperAdmin()){
    //     return $next($request);
    // }

    // foreach($roles as $role) {
    //     // Check if user has the role This check will depend on how your roles are set up
    //     if($user->role == $role){
    //         return $next($request);
    //     }
    //         elseif($user->role != $role)
    //          {
    //               return redirect()->back()->with('error',"You do not have access!"); 
    //          }
    // }
    foreach($roles as $role) {
        // Check if user has the role This check will depend on how your roles are set up
        if($user->role == $role || $user->isSuperAdmin() || $user->isAdmin()){
            // dd($user->role);
            return $next($request);
        }
            elseif($user->role != $role)
            {
                // dd($user->role); 
                return redirect()->back()->with('error',"You do not have access!"); 
            }
            
            //  elseif( $user->isAdmin( )!= true){
            // return redirect()->back()->with('error',"You do not have access!"); 
            // }
            // elseif( $user->isSuperAdmin()!= true){
            //         return redirect()->back()->with('error',"You do not have access!"); 
            // }
    }
    return redirect()->route('user.signin')->with('error',"Please Login!");
    }
}
