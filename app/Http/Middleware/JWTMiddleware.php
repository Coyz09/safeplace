<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;

class JWTMiddleware
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
        $message = '';

        try{
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        }
        catch(\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException $e){
            $message = 'Token Expired';
        }
        catch(\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException $e){
            $message = 'Invalid Token';
        }
        catch(\PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException $e){
            $message = 'Provide a Token';
        }

        return response()->json([
            'success' => false,
            'message' => $message

        ]);

    }
}
