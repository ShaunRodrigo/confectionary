<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $isAdminLogin = $request->input('login_type') === 'Login as Admin';

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // If trying to login as admin but user is not admin
            if ($isAdminLogin && $user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have admin privileges.',
                ]);
            }

            // If trying to login as regular user but user is admin
            if (!$isAdminLogin && $user->role === 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Please use the admin login button.',
                ]);
            }

            $request->session()->regenerate();
            // After login, show the normal homepage. Admins can use the Admin button on the homepage to go to the admin panel.
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }
}

