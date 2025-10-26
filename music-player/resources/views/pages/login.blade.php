@extends('pages.layout')
@section('title', 'Login')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/basic_styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login_styles.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header class="header">
            <h1>d-_-b Music Player</h1>
            <nav class="navbar">
                <a href="{{ route('pages.index') }}">Home</a>
                <a href="{{ route('pages.tracks') }}">Tracks</a>
                <a href="{{ route('pages.artists') }}">Artists</a>
                <a href="{{ route('pages.newtrack') }}">Add new</a>
                <a href="{{ route('pages.profile') }}">Profile</a>
                <a href="{{ route('pages.login') }}">Login</a>
            </nav>
        </header> 
        <main>
            <div class="login-container">
                <h2>Login!</h2>
                <form > 
                    @csrf
                    <fieldset>
                        <br>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required><br><br>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required><br>
                        <br>
                    </fieldset>
                    <br>
                    <button type="submit" value="Login" id="login-button" class="submitbutton">Login</button>
                </form>
                
                <br>
                <p class="link">
                    <a href="{{ route('pages.create') }}">Create a new user instead</a>
                </p>
            </div>

            <script src="{{ asset('js/login.js') }}"></script>
        </main>
        <footer class="bottominfo">
            © 2025 d-_-b Music Player | <a
            href="https://odin.sdu.dk/sitecore/index.php?a=fagbesk&id=157925&listid=21432&lang=en">SDU - Web
            Technologies</a> | <a href="{{ route('pages.aboutus') }}">About us</a>
        </footer>
        </body>
@endsection