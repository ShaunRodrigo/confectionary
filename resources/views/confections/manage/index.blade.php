

<style>
    body {
        font-family: 'Source Sans Pro', sans-serif;
        background: url('/images/adminbg.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #fff;
        animation: fadeIn 0.8s ease-in;
    }

    .container-box {
        max-width: 1000px;
        margin: 40px auto;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 30px;
        border-radius: 10px;
        border: 1px solid #fff;
    }

    h1 {
        text-align: center;
        font-size: 2.2em;
        font-weight: 600;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 0.1rem;
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
        padding: 8px 14px;
        border-radius: 6px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        text-decoration: none;
        margin-right: 6px;
        border: none;
        cursor: pointer;
    }

    .btn-primary { background-color: #00a8e8; color: #fff; }
    .btn-danger { background-color: #ff6f61; color: #fff; }
    .btn-create { background-color: #6c63ff; color: #fff; margin-bottom: 20px; display: inline-block; }

    
</style>

<div class="container-box">
    <h1>Manage Confections</h1>

    <a href="{{ route('confections_manage.create') }}" class="btn btn-create">+ Add New Confection</a>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($confections as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->cname }}</td>
                    <td>{{ $c->type }}</td>
                    <td>{{ $c->created_at }}</td>
                    <td>
                        <a href="{{ route('confections_manage.edit', $c) }}" class="btn btn-primary">Edit</a>
                        <form method="POST" action="{{ route('confections_manage.destroy', $c) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Delete this confection?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

