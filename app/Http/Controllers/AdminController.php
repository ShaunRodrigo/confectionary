<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.panel');
    }

    public function __construct()
    {
        // require authentication and admin role for all admin routes
        $this->middleware(['auth', \App\Http\Middleware\IsAdmin::class]);
    }

    // Show registrations (users) - newest first
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users', compact('users'));
    }

    // Show login records if a Login model/table exists
    public function logins()
    {
        $logins = collect();
        if (class_exists(\App\Models\Login::class)) {
            $logins = \App\Models\Login::orderBy('created_at', 'desc')->paginate(50);
        }
        return view('admin.logins', compact('logins'));
    }
}
