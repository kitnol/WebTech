@extends('layout')
@section('title', 'My Favorites')
@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/favorites_styles.css') }}">
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
      <h2>My Favorite Songs!</h2>
      @if ($favorites->count() < 1)
        <p class="guidetext">
          Seems like you have no favorite tracks yet! Add new favorites <a href="/tracks">here</a>!
        </p>
      @else
        <p class="guidetext">
          Here you can find a list of your favorite tracks, click on the track to find out more. d-_-b
        </p>
      @endif

      <section class="grid">
        @foreach($favorites->pluck('artist_id')->unique() as $artist_id)
          <fieldset>
            <legend>{{ auth()->user()->artists()->where('id', $artist_id)->first()->artist }}</legend>

            @php
              $songsByArtist = $favorites->where('artist_id', $artist_id)->unique('title');
            @endphp

            @foreach($songsByArtist as $song)
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

                @if(auth()->check() && auth()->user()->isPremium())
                  <form action="{{ route('favorites.toggle', $song) }}" method="POST">
                    @csrf
                    <button type="submit">
                      @if(auth()->user()->favorites->contains($song))
                        ★
                      @else
                        ☆
                      @endif
                    </button>
                  </form>
                @endif
              </article>
            @endforeach
          </fieldset>
        @endforeach
      </section>
    </main>
  </body>
@endsection
