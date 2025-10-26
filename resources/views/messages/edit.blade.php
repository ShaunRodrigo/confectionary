@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Message</h1>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('messages.update', $message) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name', $message->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" class="form-control" value="{{ old('email', $message->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Subject</label>
            <input name="subject" class="form-control" value="{{ old('subject', $message->subject) }}">
        </div>

        <div class="mb-3">
            <label>Message</label>
            <textarea name="body" class="form-control" rows="6" required>{{ old('body', $message->body) }}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Save</button>

        <a href="{{ route('messages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <form id="delete-form" method="POST" action="{{ route('messages.destroy', $message) }}" style="margin-top:10px;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Delete message?')">Delete message</button>
    </form>
</div>
@endsection
