<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/artists_styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/basic_styles.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Artists</title>
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
        <img src="https://placehold.co/300x200?text=Artist1" alt="Artist1">
        <h2>Artist 1</h2>
        <p> Some information about the artist.</p>
        <a href="#.html"><button class="button">View More</button></a>
        <!--the link should be the one to the artist page-->
      </article>

      <article class="card">
        <img src="https://placehold.co/300x200?text=Artist2" alt="Artist2">
        <h2>Artist 2</h2>
        <p> Some information about the artist.</p>
        <a href="#.html"><button class="button">View More</button></a>
      </article>

      <article class="card">
        <img src="https://placehold.co/300x200?text=Artist3" alt="Artist3">
        <h2>Artist 3</h2>
        <p> Some information about the artist.</p>
        <a href="#.html"><button class="button">View More</button></a>
      </article>

      <article class="card">
        <img src="https://placehold.co/300x200?text=Artist4" alt="Artist4">
        <h2>Artist 4</h2>
        <p> Some information about the artist.</p>
        <a href="#.html"><button class="button">View More</button></a>
      </article>

      <article class="card">
        <img src="https://placehold.co/300x200?text=Artist5" alt="Artist5">
        <h2>Artist 5</h2>
        <p> Some information about the artist.</p>
        <a href="#.html"><button class="button">View More</button></a>
      </article>

      <article class="card">
        <img src="https://placehold.co/300x200?text=Artist6" alt="Artist6">
        <h2>Artist 6</h2>
        <p> Some information about the artist.</p>
        <a href="#.html"><button class="button">View More</button></a>
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