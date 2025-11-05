@extends('layout')
@section('title', 'Song Info')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/songinfo_styles.css') }}">
  </head>

  <body>
    <main>
      <h2>Song Info d-_-b</h2>
      <section class="card">
        <div class="info-row">
          <span class="label">Song Title:</span> 
          <span class="value">{{ $song->title }}</span>
        </div>
        <div class="info-row">
          <span class="label">Artist:</span> 
          <span class="value">{{ $song->artist }}</span>
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
          <span class="value">NOT WORKING</span>
        </div>
        <div class="info-row">
          <span class="label">Music Sheet:</span> 
          <span class="value">NOT WORKING</span>
        </div>
      </section>
      <a href="{{ route('tracks')}}"><button class="button">Close</button></a>

    </main>
  </body>
@endsection