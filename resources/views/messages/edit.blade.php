
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

    .edit-container {
        max-width: 600px;
        margin: 40px auto;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 30px;
        border-radius: 10px;
        border: 1px solid #fff;
    }

    .edit-container h1 {
        text-align: center;
        font-size: 2.2em;
        font-weight: 600;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 0.1rem;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        letter-spacing: 0.05rem;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    input[type="text"],
    input[type="email"],
    input[type="subject"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
        border: 1px solid #fff;
        background: transparent;
        color: #fff;
        font-size: 1rem;
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

    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        text-decoration: none;
        margin-right: 10px;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #00a8e8;
        color: #fff;
    }

    .btn-secondary {
        background-color: #888;
        color: #fff;
    }

    .btn-danger {
        background-color: #ff6f61;
        color: #fff;
        margin-top: 10px;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>

<div class="edit-container">
    <h1>Edit Message</h1>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('messages.update', $message) }}">
        @csrf
        @method('PUT')

        <label>Name</label>
        <input name="name" type="text" value="{{ old('name', $message->name) }}" required>

        <label>Email</label>
        <input name="email" type="email" value="{{ old('email', $message->email) }}" required>

        <label>Message</label>
        <textarea name="body" rows="6" required>{{ old('body', $message->body) }}</textarea>

        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('messages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <form id="delete-form" method="POST" action="{{ route('messages.destroy', $message) }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Delete message?')">Delete Message</button>
    </form>
</div>

