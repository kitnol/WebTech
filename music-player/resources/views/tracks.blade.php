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
        @foreach(auth()->user()->songs->pluck('artist')->unique() as $artist)
          <fieldset>
            <legend>{{ $artist }}</legend>
            @php
              $songsbyartist = auth()->user()->songs
                  ->where('artist', $artist)
                  ->unique('title');
            @endphp
            @foreach($songsbyartist as $song)
              <article class="card">
                <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
                <h2>{{$song->artist}} - {{$song->title}}</h2>
            </article>
            @endforeach
          </fieldset>   
        @endforeach
      </section>

    </main>
  </body>
@endsection