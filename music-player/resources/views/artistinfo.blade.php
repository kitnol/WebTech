@extends('layout')
@section('title', 'Artist Info')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/songinfo_styles.css') }}">
  </head>

  <body>
    <main>
      <h2>Artist Info d-_-b</h2>
      <section class="card">
        <div class="info-row">
          <span class="label">Artist:</span> 
          <span class="value">{{ $artist }} </span>
          <a href="{{ route('editartist', ['artist' => $artist]) }}"><button class="button">&#9998;</button></a>
        </div>
        <div class="info-row">
          <span class="label">Total songs from your list:</span> 
          <span class="value">{{ $songs->count() }}</span>
        </div>
        <div class="info-row">
          <span class="label">Albums and songs:</span> 
          <ul class="value"> 
            @foreach($songs->unique('title') as $song) 
              <li style="text-align: left;">{{ $song->title }} ({{ $song->year }})</li>
            @endforeach
          </ul>
        </div>
        <div class="info-row">
          <span class="label">Details on artist:</span> 
          <span class="value">NOT WORKING</span>
        </div>
      </section>
      <a href="{{ route('artists')}}"><button class="button">Close</button></a>

    </main>
  </body>
@endsection