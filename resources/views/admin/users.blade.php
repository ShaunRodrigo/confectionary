@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registered Users</h1>
    <table class="table table-striped">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Registered</th></tr>
        </thead>
        <tbody>
        @foreach($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role ?? '-' }}</td>
                <td>{{ $u->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
