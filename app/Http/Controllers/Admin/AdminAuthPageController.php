<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthPageController extends Controller
{
    protected $guard = 'admin';

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard($this->guard)->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended(route('admin.dashboard'));
        }

        // Authentication failed...
        return redirect()->route('admin.login')
            ->withInput($request->only('email'))
            ->withErrors(['email' => __('auth.failed')]);
    }

    public function logout()
    {
        Auth::guard($this->guard)->logout();
        return redirect()->route('admin.login');
    }
}
