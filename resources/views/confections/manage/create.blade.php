
<style>

    body {
        background: url('/images/crudbg.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .form-box {
        max-width: 600px;
        margin: 40px auto;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 30px;
        border-radius: 10px;
        border: 1px solid #fff;
        color: #fff;
    }

    .form-box h1 {
        text-align: center;
        font-size: 2em;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.1rem;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
        border: 1px solid #fff;
        background: transparent;
        color: #fff;
        font-size: 1rem;
    }

    .checkbox-group {
        margin-bottom: 20px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        text-decoration: none;
        margin-right: 10px;
        border: none;
        cursor: pointer;
    }

    .btn-primary { background-color: #00a8e8; color: #fff; }
    .btn-secondary { background-color: #888; color: #fff; }
    .btn-third {
        background-color: #ffdd57;
        color: #000;
    }

</style>

<body>
<div class="form-box">
    <h1>Add Confection</h1>

    @if($errors->any())
        <ul style="color: #ff6f61;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('confections_manage.store') }}">
        @csrf

        <label for="cname">Name</label>
        <input type="text" name="cname" id="cname" value="{{ old('cname') }}" required>

        <label for="type">Type</label>
        <input type="text" name="type" id="type" value="{{ old('type') }}" required>

        <div class="checkbox-group">
            <label>
                <input type="checkbox" name="prizewinning" value="1" {{ old('prizewinning') ? 'checked' : '' }}>
                Prizewinning
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('confections_manage.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
        <a href="{{ route('confections_manage.index') }}" class="btn btn-third">← Back to Database</a>

</div>
</body>