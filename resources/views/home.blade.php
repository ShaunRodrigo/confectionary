@extends('layouts.app')

@section('content')
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <div class="logo">
            <span class="icon fa-gem"></span>
        </div>
        <div class="content">
            <div class="inner">
                <h1>Confectionary Delights</h1>
                <p>Welcome,@auth {{ auth()->user()->name }}! @else Guest! @endauth</p>
                <p>Handcrafted sweets, timeless recipes, and a sprinkle of magic.</p>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="{{ route('Our Products') }}">Products</a></li>
                <li><a href="#graph">Graph</a></li>

                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endguest


                @auth
                    <li><a href="#messages">Messages</a></li>
                    @if(auth()->user()->role === 'admin')
                        <li><a href="#crud">Manage Products</a></li>
                        <li><a href="{{ route('admin.panel') }}">Admin</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();"style="display: block; min-width: 7.5rem; height: 2.75rem; line-height: 2.75rem; padding: 0 1.25rem 0 1.45rem; text-transform: uppercase; letter-spacing: 0.2rem; font-size: 0.8rem; border-bottom: 0;">Logout</a>
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <div id="main">

        <!-- Home -->
        <article id="home">
            <h2 class="major">Welcome</h2>
            <span class="image main"><img src="{{ asset('images/pic01.jpg') }}" alt="" /></span>
            <p>Welcome to our dessert studio. We blend tradition and creativity to craft unforgettable confections.</p>
        </article>

        <!-- Contact -->
        <article id="contact">
            <h2 class="major">Contact</h2>

            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            <form method="post" action="{{ route('contact.send') }}">
                @csrf
                <div class="fields">
                    <div class="field half">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" />
                        @error('name') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="field half">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}" />
                        @error('email') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="field">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" rows="4">{{ old('message') }}</textarea>
                        @error('message') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Send Message" class="primary" /></li>
                    <li><button type="button" id="contact-reset">Reset</button></li>
                </ul>
            </form>
            <ul class="icons">
                <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
            </ul>
        </article>

        <!-- Database -->
        


        <!-- Graph -->
        <article id="graph">
            <h2 class="major">Sales Overview</h2>
            <canvas id="salesChart"></canvas>
        </article>

        <!-- Messages (only for logged-in users) -->
        @auth
        <article id="messages">
            <h2 class="major">Messages</h2>
            @if(!empty($messages) && $messages->count())
                <ul class="messages-list">
                    @foreach($messages as $m)
                        <li class="message-item">
                            <strong>{{ $m->name }}</strong> <small>&lt;{{ $m->email }}&gt;</small>
                            <div class="message-meta">{{ $m->created_at->format('Y-m-d H:i') }}</div>
                            <p>{{ $m->body }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No messages yet.</p>
            @endif
        </article>
        @endauth

        <!-- CRUD (only for admin) -->
        @auth
            @if(auth()->user()->role === 'admin')
                <article id="crud">
                    <h2 class="major">Manage Products</h2>
                    <p>Admin-only CRUD interface for managing product records.</p>
                </article>

                <article id="admin">
                    <h2 class="major">Admin Panel</h2>
                    <p>Admin-only tools and settings.</p>
                </article>
            @endif
        @endauth
    </div>

    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">&copy; Confectionary Delights.</p>
    </footer>
</div>

<!-- Background -->
<div id="bg"></div>
<script>
    // Clear the contact form fields and validation messages when the custom Reset button is clicked
    (function(){
        var btn = document.getElementById('contact-reset');
        if (!btn) return;
        btn.addEventListener('click', function(){
            var form = this.closest('form');
            if (!form) return;
            // clear common editable fields but DO NOT remove hidden inputs (CSRF token)
            var fields = form.querySelectorAll('input[type=text], input[type=email], textarea, select');
            fields.forEach(function(f){ f.value = ''; });
            // clear checkboxes/radios
            var checks = form.querySelectorAll('input[type=checkbox], input[type=radio]');
            checks.forEach(function(c){ c.checked = false; });
            // remove validation error elements with class 'error'
            var errors = form.querySelectorAll('.error');
            errors.forEach(function(e){ e.parentNode && e.parentNode.removeChild(e); });
            // remove success message if present
            var success = document.querySelector('.success-message');
            if (success) success.parentNode.removeChild(success);
        });
    })();
</script>
@endsection