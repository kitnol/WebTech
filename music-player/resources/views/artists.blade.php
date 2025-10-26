@extends('layout')
@section('title', 'Artists')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/artists_styles.css') }}">
  </head>

  <body>
    <main>
      <section class="grid">
        @foreach(auth()->user()->songs->pluck('artist')->unique() as $artist)
          <article class="card">
            <img src="https://placehold.co/300x200?text=Artist1" alt="Artist1">
            <h2>{{$artist}}</h2>
            <p> Some information about the artist.</p>
            <a href="#.html"><button class="button">View More</button></a>
            <!--the link should be the one to the artist page-->
          </article>
        @endforeach
      </section>
    </main>
  </body>
@endsection

        
        <!--
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
        -->