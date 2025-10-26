<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // Show messages (only for logged-in users via routes)
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(20);
        return view('messages.index', compact('messages'));
    }

    // Admin: edit message
    public function edit(Message $message)
    {
        return view('messages.edit', compact('message'));
    }

    // Admin: update message
    public function update(Request $request, Message $message)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'body' => 'required|string',
        ]);

        $message->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'] ?? null,
            'body' => $data['body'],
        ]);

        return redirect()->route('messages.index')->with('status', 'Message updated.');
    }

    // Admin: delete message
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index')->with('status', 'Message deleted.');
    }
}
