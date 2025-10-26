@extends('pages.layout')
@section('title', 'Registration')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/basic_styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/create_styles.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Music Player</title>
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
                <h2>New user:</h2>
                <form method="POST" action="{{ route('pages.userstore') }}">
                    @csrf <!-- you should include a hidden CSRF token field in the form so that the CSRF protection middleware can validate the request. You may use the @csrf Blade directive to generate the token field-->
                    <fieldset>
                        <br>
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" minlength="5" required><br><br>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                            required><br><br>
                    </fieldset>
                    <button type="submit" value="Create" id="createbutton" class="submitbutton">Create</button>
                </form>
            </div>
        </main>

        <footer class="bottominfo">
            © 2025 d-_-b Music Player | <a
            href="https://odin.sdu.dk/sitecore/index.php?a=fagbesk&id=157925&listid=21432&lang=en">SDU - Web
            Technologies</a> | <a href="{{ route('pages.aboutus') }}">About us</a>
        </footer>
    </body>

    </html>
@endsection