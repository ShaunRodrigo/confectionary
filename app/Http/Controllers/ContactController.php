<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle contact form submission.
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:5',
        ]);

        $message = Message::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'body' => $data['message'],
        ]);

        // Try to send an email notification to the configured MAIL_FROM_ADDRESS if available
        try {
            if (config('mail.from.address')) {
                Mail::raw($message->body, function ($m) use ($message) {
                    $m->to(config('mail.from.address'))
                      ->subject('New contact message from ' . $message->name)
                      ->replyTo($message->email);
                });
            }
        } catch (\Throwable $e) {
            // Do not fail the request if mail is not configured; just continue
        }

        return redirect()->back()->with('success', 'Your message was sent. Thank you!');
    }
}
