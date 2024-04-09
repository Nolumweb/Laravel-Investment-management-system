<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticateMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin/logout')) {
            auth()->guard('admin')->logout();
            return redirect()->route('admin.login');
        }
    
        // if (auth()->guard('admin')->check()) {
        //     return $next($request);
        // }

        if (auth()->guard('admin')->check()) {
            // Set session lifetime to a very high value or disable expiration
            config(['session.lifetime' => 525600]); // 525600 minutes = 1 year
            config(['session.expire_on_close' => false]);
            return $next($request);
        }
    
        return redirect()->route('admin.login');
    }
    




}
