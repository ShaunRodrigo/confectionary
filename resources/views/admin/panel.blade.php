@extends('layouts.app')

@section('content')
<div id="wrapper">

    <header id="header">
        <div class="logo">
            <span class="icon fa-gem"></span>
        </div>
        <div class="content">
            <div class="inner">
                <h1>Admin Panel</h1>
                <p>Administrative tools and records. Use the links below to manage the site.</p>
            </div>
        </div>
        {{-- Prominent admin action links placed near the header so they are immediately visible --}}
        <div style="padding:18px 24px; background:transparent; text-align:center; margin-top:-10px;">
            <a href="{{ route('admin.users') }}" style="display:inline-block;margin:6px;padding:12px 18px;background:#6c63ff;color:#fff;border-radius:6px;text-decoration:none;font-weight:700;">Registered Users</a>
            <a href="{{ route('admin.logins') }}" style="display:inline-block;margin:6px;padding:12px 18px;background:#00a8e8;color:#fff;border-radius:6px;text-decoration:none;font-weight:700;">Login Records</a>
            <a href="{{ route('messages.index') }}" style="display:inline-block;margin:6px;padding:12px 18px;background:#ff7a59;color:#fff;border-radius:6px;text-decoration:none;font-weight:700;">Manage Messages</a>
        </div>
    </header>

    <div id="main">
        <article id="contact">
            <h2 class="major">Admin Actions</h2>

            <div class="form-box">
                <div class="fields">
                    <div class="field">
                        <p><a class="button primary" href="{{ route('admin.users') }}">Registered Users</a></p>
                    </div>
                    <div class="field">
                        <p><a class="button" href="{{ route('admin.logins') }}">Login Records</a></p>
                    </div>
                    <div class="field">
                        <p><a class="button" href="{{ route('messages.index') }}">Manage Messages</a></p>
                    </div>
                </div>
                <ul class="actions">
                    <li><a href="/" class="button">Back to Site</a></li>
                </ul>
            </div>
        </article>
    </div>

</div>
@endsection
