@extends('layout')
@section('title', 'Tracks')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/tracks_styles.css') }}">
    <script defer src="{{ asset('js/tracks.js') }}"></script>
  </head>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script>


      async function delete_song(id) {
          if (confirm("Are you sure you want to delete this songs?")) {
              try {
                  const response = await fetch('/destroysong', {
                      method: 'POST',
                      headers: {
                          'Content-Type': 'application/json',
                          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                      },
                      body: JSON.stringify({ id })
                  });

                  const data = await response.json();

                  if (response.ok) {
                      window.location.href = '/tracks'; // Redirect to artists page
                  } else {
                      alert(data.error || "Failed to delete artist.");
                  }
              } catch (error) {
                  console.error("Error deleting artist:", error);
                  alert("An error occurred while deleting the artist.");
              }
          }
      }
  </script>

  <body>
    <main>
      <h2>Tracks!</h2>
      @if (auth()->user()->songs->count() < 1)
        <p class="guidetext">
          Seems like you have no tracks saved yet! Add new <a href="/newtrack">here</a>!
        </p>
      @else
        <p class="guidetext">
          Here you can find a list of all your tracks, click on the track to find out more. d-_-b
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
                  <a href="{{ route('home', ['play' => $song->id]) }}" class="play-link">
                    <button onclick="player.play()">
                      <i id="playBt" class="fa fa-play"></i>
                    </button>
                  </a>

                  <a href="{{ route('songinfo', ['song' => $song->id]) }}" class="cardtext">
                    {{ auth()->user()->artists()->where('id', $song->artist_id)->first()->artist }} - {{ $song->title }}
                  </a>
                    <button onclick="delete_song({{ $song->id }})">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </article>
              @endforeach
            </fieldset>
          @endforeach
        </section>
      @endif
    </main>
  </body>
@endsection
