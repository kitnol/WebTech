@extends('layout')
@section('title', 'Tracks')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/tracks_styles.css') }}">
    <script defer src="{ asset('js/tracks.js') }}"></script>
  </head>

  <body>
    <main>
      <h2>Tracks!</h2>
      <p class="guidetext">Here you can find a list of all your tracks, click on the track to find out more. d-_-b</p>
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
                <a href="{{ route('home', ['play' => $song->id]) }}" class="play-link">
                  <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
                </a>
                <a href="{{ route('songinfo', ['song' => $song->id]) }}" class="cardtext">{{$song->artist}} - {{$song->title}}</a>
                  <button><i class="fa fa-trash" aria-hidden="true"></i></button>
              </article>
            @endforeach
          </fieldset>
        @endforeach
      </section>

    </main>
  </body>
@endsection
