<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class HomeController extends Controller
{
    public function index()
    {
        $messages = [];
        if (auth()->check()) {
            $messages = Message::orderBy('created_at', 'desc')->get();
        }

        return view('home', compact('messages'));
    }
}