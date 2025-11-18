@extends('layout')
@section('title', 'Song Info')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/songinfo_styles.css') }}">
    <script src="{{ asset('js/editsong.js') }}"></script>
  </head>

  <body>
    <main>
      <h2>Song Info d-_-b</h2>
      <section class="card" id="song-info">
        <div class="info-row">
          <span class="label">Song Title:</span>
          <span class="value">{{ $song->title }}</span>
        </div>
        <div class="info-row">
          <span class="label">Artist:</span>
          <span class="value">{{ auth()->user()->artists()->where('id', $song->artist_id)->first()->artist, }}</span>
        </div>
        <div class="info-row">
          <span class="label">Album:</span>
          <span class="value">{{ $song->album }}</span>
        </div>
        <div class="info-row">
          <span class="label">Year:</span>
          <span class="value">{{ $song->year }}</span>
        </div>
        <div class="info-row">
          <span class="label">Description:</span>
          <span class="value">{{ $song->description }}</span>
        </div>
        <div class="info-row">
          <span class="label">Track:</span>
          <span class="value"><a href="{{ route('song.download', $song->id) }}"><button class="button">Downloads</button></a></span>
        </div>
        <a href="javascript:editSong()"><button class="button">Edit</button></a>
      </section>
      <section class="card" id="song-edit" style="display:none;">
        <form action="{{ route('editsong.post') }}" method="POST">
          @csrf
          <input type="hidden" name="song_id" value="{{ $song->id }}">
          <div class="info-row">
            <span class="label">Song Title:</span>
            <input type="text" id="title" name="title" value="{{ $song->title }}" required>
          </div>
          <div class="info-row">
            <span class="label">Artist:</span>
              <span class="value">{{ auth()->user()->artists()->where('id', $song->artist_id)->first()->artist, }}</span>
          </div>
          <div class="info-row">
            <span class="label">Album:</span>
            <input type="text" id="album" name="album" value="{{ $song->album }}">
          </div>
          <div class="info-row">
            <span class="label">Year:</span>
            <input type="text" id="year" name="year" value="{{ $song->year }}">
          </div>
          <div class="info-row">
            <span class="label">Description:</span>
            <textarea id="description" name="description">{{ $song->description }}</textarea>
          </div>
          <div class="info-row">
            <span class="label">Track:</span>
              <span class="value"><button class="deactivatebutton" disabled>Downloads</button></a></span>
          </div>
          <button type="submit" class="button">Save song</button>
        </form>
        <a href="javascript:cancelSong()"><button class="button">Cancel</button></a>
      </section>
      <a href="{{ route('tracks')}}"><button class="button">Close</button></a>

    </main>
  </body>
@endsection
