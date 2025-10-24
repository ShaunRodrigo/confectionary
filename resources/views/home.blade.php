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
                <p>Handcrafted sweets, timeless recipes, and a sprinkle of magic.</p>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="{{ route('Our Products') }}">Products</a></li>
                <li><a href="#graph">Graph</a></li>
                @auth
                    <li><a href="#messages">Messages</a></li>
                    @if(auth()->user()->role === 'admin')
                        <li><a href="#crud">Manage Products</a></li>
                        <li><a href="#admin">Admin</a></li>
                    @endif
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
            <form method="post" action="#">
                <div class="fields">
                    <div class="field half">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" />
                    </div>
                    <div class="field half">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" />
                    </div>
                    <div class="field">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" rows="4"></textarea>
                    </div>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Send Message" class="primary" /></li>
                    <li><input type="reset" value="Reset" /></li>
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
            <p>View messages submitted through the contact form.</p>
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
        <p class="copyright">&copy; Confectionary Delights. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
    </footer>
</div>

<!-- Background -->
<div id="bg"></div>
@endsection
