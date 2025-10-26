@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Login Records</h1>
    @if($logins->isEmpty())
        <p>No login records found.</p>
    @else
    <table class="table table-striped">
        <thead><tr><th>ID</th><th>User ID</th><th>IP</th><th>User Agent</th><th>At</th></tr></thead>
        <tbody>
        @foreach($logins as $l)
            <tr>
                <td>{{ $l->id }}</td>
                <td>{{ $l->user_id }}</td>
                <td>{{ $l->ip }}</td>
                <td>{{ $l->user_agent }}</td>
                <td>{{ $l->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $logins->links() }}
    @endif
</div>
@endsection
