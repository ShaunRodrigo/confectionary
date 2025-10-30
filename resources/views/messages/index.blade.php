
<style>
    body {
        font-family: 'Source Sans Pro', sans-serif;
        background: url('/images/adminbg.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
        animation: fadeIn 0.8s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .messages-container {
        max-width: 1000px;
        margin: 40px auto;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 30px;
        border-radius: 10px;
        border: 1px solid #fff;
    }

    .messages-container h1 {
        text-align: center;
        font-size: 2.2em;
        font-weight: 600;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 0.1rem;
    }

    .alert-success {
        background-color: rgba(40, 167, 69, 0.2);
        border: 1px solid #28a745;
        color: #28a745;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 20px;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    thead {
        background-color: rgba(255, 255, 255, 0.1);
    }

    th, td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #444;
    }

    th {
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.05rem;
        color: #ffdd57;
    }

    tr:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }

    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        text-decoration: none;
        margin-right: 6px;
        display: inline-block;
    }

    .btn-primary {
        background-color: #00a8e8;
        color: #fff;
        border: none;
    }

    .btn-danger {
        background-color: #ff6f61;
        color: #fff;
        border: none;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-link {
        background: transparent;
        border: 1px solid #fff;
        color: #fff;
        padding: 8px 12px;
        margin: 0 4px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
    }

    .pagination .page-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>

<div class="messages-container">
    <h1>Messages</h1>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Received</th>
                @auth
                    <th>Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->email }}</td>
                    <td>{{ Str::limit($m->body, 80) }}</td>
                    <td>{{ $m->created_at }}</td>
                    @auth
                        <td>
                            @if(auth()->user()->role === 'admin')
                                <a class="btn btn-primary" href="{{ route('messages.edit', $m) }}">Edit</a>
                                <form style="display:inline" method="POST" action="{{ route('messages.destroy', $m) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Delete message?')">Delete</button>
                                </form>
                            @endif
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $messages->links() }}
    </div>
</div>

