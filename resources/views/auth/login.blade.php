<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: url('/images/loginbg.jpg') no-repeat center center fixed;
            background-size: cover;
            padding: 40px;
            color: #ffffff;
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5em;
            font-weight: 600;
            letter-spacing: 0.2rem;
            text-transform: uppercase;
        }

        .form-box {
            background-color: rgba(0, 0, 0, 0.6);
            border: 1px solid #ffffff;
            padding: 30px;
            border-radius: 8px;
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            letter-spacing: 0.1rem;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #fff;
            background: transparent;
            color: #fff;
            font-size: 1rem;
        }

        input[type="submit"] {
            background: transparent;
            color: #fff;
            border: 1px solid #fff;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .error-list {
            color: #ff6f61;
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
