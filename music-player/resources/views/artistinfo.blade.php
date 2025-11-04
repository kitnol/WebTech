@extends('layout')
@section('title', 'Artist Info')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/songinfo_styles.css') }}">
    <script src="{{ asset('js/artist.js') }}"></script>
  </head>

  <body>
    <main>
      <h2>Artist Info d-_-b</h2>
      <section class="card">
        <div class="info-row" id="artist-info">
          <span class="label">Artist:</span> 
          <span class="value">{{ $artist }} </span>
          <a href="javascript:editArtist()"><button class="button">&#9998;</button></a>
        </div>
        <div class="info-row" id="artist-edit" style="display:none;">
          <form action="{{ route('editartist.post') }}" method="POST">
              @csrf
              <input type="hidden" name="current_artist" value="{{ $artist }}">
              <div class="info-row">
                  <label for="artist" class="label">Artist:</label>
                  <input type="text" id="new_artist" name="new_artist" value="{{$artist}}" required>
              </div>
              <button type="submit" class="button">Save artist</button>
          </form>
          <a href="javascript:cancelArtist()"><button class="button">&#10006;</button></a>
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
    </main>
  </body>
@endsection