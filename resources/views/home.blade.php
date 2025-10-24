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
                <li><a href="#intro">Intro</a></li>
                <li><a href="#work">Work</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <div id="main">

        <!-- Intro -->
        <article id="intro">
            <h2 class="major">Intro</h2>
            <span class="image main"><img src="{{ asset('images/pic01.jpg') }}" alt="" /></span>
            <p>Welcome to our dessert studio. We blend tradition and creativity to craft unforgettable confections.</p>
        </article>

        <!-- Work -->
        <article id="work">
            <h2 class="major">Work</h2>
            <span class="image main"><img src="{{ asset('images/pic02.jpg') }}" alt="" /></span>
            <p>Explore our handcrafted sweets, from velvety ganache to crunchy pralines. Each piece is a work of edible art.</p>
        </article>

        <!-- About -->
        <article id="about">
            <h2 class="major">About</h2>
            <span class="image main"><img src="{{ asset('images/pic03.jpg') }}" alt="" /></span>
            <p>We’re a boutique dessert studio specializing in artisan confections. Made with love and legacy.</p>
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
    </div>

    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">&copy; Confectionary Delights. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
    </footer>
</div>

<!-- Background -->
<div id="bg"></div>
@endsection
