@extends('layout')
@section('title', 'Artists')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/artists_styles.css') }}">
  </head>

  <body>
    <main>
      <h2>Artists!</h2>
      <p class="guidetext">
        Here you can find a list of all your artists, click on the artist to find out more. d-_-b
      </p>
      <section class="grid">
        @foreach(auth()->user()->songs->pluck('artist')->unique() as $artist)
          <article class="card">
            <img src="https://placehold.co/300x200?text={{$artist}}" alt="{{$artist}}">
            <a href="{{ route('artistinfo', ['artist' => $artist]) }}" class="cardtext">{{$artist}}</a>
            <p> Total songs in your list: {{ auth()->user()->songs->where('artist', $artist)->count() }}</p>
            <a href="{{ route('tracks')}}"><button class="button">View Songs</button></a>
          </article>
        @endforeach
      </section>
    </main>
  </body>
@endsection