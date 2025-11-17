@extends('layout')
@section('title', 'Artists')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/artists_styles.css') }}">
  </head>

  <body>
    <main>
      <h2>Artists!</h2>
      @if (auth()->user()->artists()->count() < 1)
        <p class="guidetext">
          Seems like you have no artists saved yet! Add a new track <a href="/newtrack">here</a>!
        </p>
      @else
        <p class="guidetext">
        Here you can find a list of all your artists, click on the artist to find out more. d-_-b
        </p>

        <section class="grid">
          @foreach(auth()->user()->artists()->distinct()->get() as $artist)
                @php

                    if($artist->cover_art_path !== null)
                    {
                        $artist_img_url = "http://127.0.0.1:8000/storage/" . $artist->cover_art_path;
                    }
                    else{
                        $artist_img_url = "https://placehold.co/300x200/A837B8/ffffff?text=" . $artist->artist;
                    }

                @endphp
            <article class="card">
              <img src="{{$artist_img_url}}" alt="{{$artist->artist}}" class="artistimage">
              <p class="cardtext">{{$artist->artist}}</p>
              <p> Total songs in your list: {{ auth()->user()->songs()->where('artist_id', $artist->id)->count() }}</p>
              <a href="{{ route('artistinfo', ['artist_id' => $artist->id]) }}"><button class="button">View More</button></a>
            </article>
          @endforeach
        </section>
      @endif

    </main>
  </body>
@endsection
