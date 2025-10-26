<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #1c1c1c;
            padding: 40px;
            color: #f0f0f0;
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            color: #ffdd57;
            text-align: center;
            margin-bottom: 40px;
            font-size: 3em;
            font-family: 'Brush Script MT', cursive;
            text-shadow: 1px 1px #000;
        }

        .form-box {
            background: #2a2a2a;
            border: 1px solid #444;
            padding: 30px;
            border-radius: 12px;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 2px 8px rgba(255,255,255,0.04);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #ffdd57;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #555;
            background: #1c1c1c;
            color: #f0f0f0;
        }

        input[type="submit"] {
            background: #ff6f61;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #e85c50;
        }

        .error-list {
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .success-message {
            color: #2ecc71;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Login</h1>

    <div class="form-box">
        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required />

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />

            <input type="submit" value="Login" />
        </form>
    </div>
</body>
</html>
