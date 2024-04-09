<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        

    if (Auth::check() && Auth::user()->ustatus == 0) {
        return redirect()->route('login')->with('error', 'Your account has been banned.');
    }
    
        // $userStatus = $request->user()->ustatus;
        
        // if (!$userStatus) {
        // return redirect()->route('not-authorized')->with('error', 'Your account is currently restricted.');
        // }

    return $next($request);
}

  

    
  
}





