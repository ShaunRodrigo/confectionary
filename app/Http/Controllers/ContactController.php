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
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:5',
        ]);

        // If validation fails, redirect back to the previous page keeping the #contact anchor
        if ($validator->fails()) {
            $previous = url()->previous();
            // ensure fragment exists
            if (strpos($previous, '#') === false) {
                $previous = $previous . '#contact';
            } else {
                // replace existing fragment
                $previous = preg_replace('/#.*/', '#contact', $previous);
            }

            return redirect($previous)
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

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

        // Redirect back to the contact anchor so the user remains at the contact section
        $previous = url()->previous();
        if (strpos($previous, '#') === false) {
            $previous = $previous . '#contact';
        } else {
            $previous = preg_replace('/#.*/', '#contact', $previous);
        }

        return redirect($previous)->with('success', 'Your message was sent. Thank you!');
    }
}
