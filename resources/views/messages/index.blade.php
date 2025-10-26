@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Messages</h1>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table table-striped">
        <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Received</th>@auth<th>Actions</th>@endauth</tr></thead>
        <tbody>
        @foreach($messages as $m)
            <tr>
                <td>{{ $m->id }}</td>
                <td>{{ $m->name }}</td>
                <td>{{ $m->email }}</td>
                <td>{{ $m->subject }}</td>
                <td>{{ Str::limit($m->body, 80) }}</td>
                <td>{{ $m->created_at }}</td>
                @auth
                <td>
                    @if(auth()->user()->role === 'admin')
                        <a class="btn btn-sm btn-primary" href="{{ route('messages.edit', $m) }}">Edit</a>
                        <form style="display:inline" method="POST" action="{{ route('messages.destroy', $m) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete message?')">Delete</button>
                        </form>
                    @endif
                </td>
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $messages->links() }}
</div>
@endsection
