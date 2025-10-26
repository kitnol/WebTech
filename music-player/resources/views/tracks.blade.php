@extends('layout')
@section('title', 'Tracks')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/tracks_styles.css') }}">
    <script defer src="{ asset('js/tracks.js') }}"></script>
  </head>

  <body>
    <main>
      <h2>Tracks</h2>
      <p>
        Here you can find a list of all your tracks. d-_-b
      </p>
      <section class="grid">
        @foreach(auth()->user()->songs as $song)
          <article class="card">
          <h2>{{$song->title}} - {{$song->artist}}</h2>
          <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
        </article>
        @endforeach
      </section>

    </main>
  </body>
@endsection