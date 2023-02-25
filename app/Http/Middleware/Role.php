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
    if (!Auth::guard('web')->check()) 
    {
        return redirect()->route('user.signin')->with('error',"You do not have access! Please Login to your authorized account.");
    }

    $user = Auth::guard('web')->user();
    // $user = Auth::user();
  

    if( $user->isAdmin()){
        return $next($request);
    }

    elseif( $user->isSuperAdmin()){
        return $next($request);
    }

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
            else
            // if($user->role != $role || $user->isSuperAdmin() == false || $user->isAdmin() == false )
            {
                // dd($user->role);
                Auth::guard('web')->logout();
                return redirect()->back()->with('error',"You do not have access! Please Login to your authorized account."); 
            }
            
            //  elseif( $user->isAdmin( )!= true){
            // return redirect()->back()->with('error',"You do not have access!"); 
            // }
            // elseif( $user->isSuperAdmin()!= true){
            //         return redirect()->back()->with('error',"You do not have access!"); 
            // }
    }
    // dd($user->role);
    Auth::guard('web')->logout();
    return redirect()->route('user.signin')->with('error',"You do not have access! Please Login to your authorized account.");
    }
}
