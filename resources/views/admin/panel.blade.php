<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: url('/images/adminbg.jpg') no-repeat center center fixed;
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
            margin-bottom: 20px;
            font-size: 2.5em;
            font-weight: 600;
            letter-spacing: 0.2rem;
            text-transform: uppercase;
            color: #000000ff;
        }

        p {
            text-align: center;
            font-size: 1.2em;
            color: #000000ff;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .form-box {
            background-color: rgba(35, 34, 34, 0.6);
            border: 1px solid #ffffff;
            padding: 30px;
            border-radius: 8px;
            max-width: 450px;
            margin: 0 auto;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
            margin-bottom: 30px;
        }

        .button-group a {
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            color: #fff;
            border: 1px solid #fff;
            transition: background-color 0.3s ease;
        }

        .button-group a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .back-link {
            text-align: center;
        }

        .back-link a {
            color: #fff;
            border: 1px solid #fff;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .back-link a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>

    <div class="form-box">
        <div class="button-group">
            <a href="{{ route('admin.users') }}">Registered Users</a>
            <a href="{{ route('admin.logins') }}">Login Records</a>
            <a href="{{ route('messages.index') }}">Manage Messages</a>
        </div>

        <div class="back-link">
            <a href="/">Back to Site</a>
        </div>
    </div>

    <p>Administrative tools and records. Use the links below to manage the site.</p>

</body>
</html>

