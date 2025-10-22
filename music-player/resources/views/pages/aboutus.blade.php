<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/about_styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/basic_styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>About us</title>
</head>

<body>
    <!--Header-->
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
    </header> <!--Header-->
    <main>
        <section class="grid">
            <article class="card">
                <h2>About d-_-b</h2>
                <p>
                    Welcome, dear visitor! <br><br>
                    We are five humble Mechatronics students, currently in our 5th semester at SDU, carrying forth the
                    proud tradition of building websites.
                    <br><br>
                    Our specialty? A fine little music player website, lovingly handcrafted for your listening pleasure.
                    Here, you may not only enjoy the sweet sounds of your favorite tracks, but also bring your own!
                    <br><br>
                    This whole venture is part of the prestigious course “Web Technologies 2025”, where we perfect the
                    art of turning late-night coffee and questionable code into a proper website.
                    <br><br>
                    Please, make yourself at home!

                </p>
            </article>
    </main>
    <footer class="bottominfo">
        © 2025 d-_-b Music Player | <a
        href="https://odin.sdu.dk/sitecore/index.php?a=fagbesk&id=157925&listid=21432&lang=en">SDU - Web
        Technologies</a> | <a href="{{ route('pages.aboutus') }}">About us</a>
    </footer>
</body>

</html>