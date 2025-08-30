<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        // Always use admin login view for admin routes
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Log the login activity
            ActivityService::logLogin(Auth::user());

            // Redirect to vehicles page after login (without /admin prefix since routes are already prefixed)
            return redirect()->intended('/vehicles');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        // Log the logout activity before logging out
        if (Auth::check()) {
            ActivityService::logLogout(Auth::user());
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Simple redirect to admin login page (without /admin prefix since routes are already prefixed)
        return redirect('/login');
    }
}
