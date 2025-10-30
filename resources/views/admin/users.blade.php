
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

    .users-container {
        max-width: 1000px;
        margin: 40px auto;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 30px;
        border-radius: 10px;
        border: 1px solid #fff;
    }

    .users-container h1 {
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
        color: #ff5757ff;
    }

    tr:hover {
        background-color: rgba(255, 255, 255, 0.05);
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

<div class="users-container">
    <h1>Registered Users</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Registered</th>
            </tr>
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

    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>

