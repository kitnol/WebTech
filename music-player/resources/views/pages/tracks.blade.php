<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/basic_styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/tracks_styles.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script defer src="{ asset('js/tracks.js') }}"></script>
  <title>Tracks</title>
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
    <h2>Tracks</h2>
    <p>
      Here you can find a list of all your tracks. d-_-b
    </p>
    <section class="grid">
      <article class="card">
        <h2>Track 1 - Artist 1</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>
      <article class="card">
        <h2>Track 2 - Artist 2</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>
      <article class="card">
        <h2>Track 3 - Artist 3</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>
      <article class="card">
        <h2>Track 4 - Artist 4</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>
      <article class="card">
        <h2>Track 5 - Artist 5</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>
      <article class="card">
        <h2>Track 6 - Artist 6</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>
      <article class="card">
        <h2>Track 7 - Artist 7</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>
      <article class="card">
        <h2>Track 8 - Artist 8</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>
      <article class="card">
        <h2>Track 9 - Artist 9</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>
      <article class="card">
        <h2>Track 10 - Artist 10</h2>
        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
      </article>

    </section>

  </main>
  <footer class="bottominfo">
    © 2025 d-_-b Music Player | <a
    href="https://odin.sdu.dk/sitecore/index.php?a=fagbesk&id=157925&listid=21432&lang=en">SDU - Web 
    Technologies</a> | <a href="{{ route('pages.aboutus') }}">About us</a>
  </footer>
</body>

</html>