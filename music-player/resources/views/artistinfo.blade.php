@extends('layout')
@section('title', 'Artist Info')
@section('content')
  <head>
    <link rel="stylesheet" href="{{ asset('css/artistinfo_styles.css') }}">
    <script src="{{ asset('js/artist.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      @php
          $artist_it = $artist->id;
      @endphp

      let artist_id = {{$artist->id}};
      console.log("Artist ID: " + artist_id);
      async function delete_artist(id) {
        if (confirm("Are you sure you want to delete this artist and all their songs?")) {
          try {
            const response = await fetch('/destroyartist', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
              },
              body: JSON.stringify({ id })
            });

            const data = await response.json();

            if (response.ok) {
              window.location.href = '/artists'; // Redirect to artists page
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
  </head>

  <body>
    <main>
      <h2>Artist Info d-_-b</h2>
      @error('error')
      <span class="error-message">{{ $message }}</span>
      @enderror
      @error('cover_art_path')
      <span class="error-message">{{ $message }}</span>
      @enderror
      @error('success')
      <span class="error-message">{{ $message }}</span>
      @enderror
      <section class="card">
        <div>

          @php
          if($artist->cover_art_path !== null){
            $artist_img_url = "http://127.0.0.1:8000/storage/" . $artist->cover_art_path;
          }
          else{
            $artist_img_url = "https://placehold.co/300x200/A837B8/ffffff?text=" . $artist->artist;
          }
          @endphp

          <img src="{{$artist_img_url}}" alt="{{$artist->artist}}" class="artistimage">
            <div id="photo-info"><a href="javascript:editPhoto()"><button class="button">&#9998;</button></a></div>
            <div class="info-row" id="photo-edit" style="display:none;">
              <form action="{{ route('editartist-photo.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="artist_id" value="{{ $artist->id }}">
                <input type="file" name="cover_art_path" required>
                <button type="submit">Upload</button>
              </form>
              <a href="javascript:cancelArtist()"><button class="button">&#10006;</button></a>
            </div>
        </div>

              @endphp
        <img src="{{$artist_img_url}}" alt="{{$artist->artist}}" class="artistimage">
              <div id="photo-info"><a href="javascript:editPhoto()"><button class="button">&#9998;</button></a></div>
              <div class="info-row" id="photo-edit" style="display:none;">
                  <form action="{{ route('editartist-photo.post') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="artist_id" value="{{ $artist->id }}">
                      <input type="file" name="cover_art_path" required>
                      <button type="submit">Upload</button>
                  </form>
                  <a href="javascript:cancelPhoto()"><button class="button">&#10006;</button></a>
              </div>
          </div>
        <div class="info-row" id="artist-info">
          <span class="label">Artist:</span>
          <span class="value">{{ $artist->artist }} </span>
          <a href="javascript:editArtist()"><button class="button">&#9998;</button></a>
        </div>
        <div class="info-row" id="artist-edit" style="display:none;">
          <form action="{{ route('editartist.post') }}" method="POST">
            @csrf
            <input type="hidden" name="artist_id" value="{{ $artist->id }}">
            <div class="info-row">
              <label for="artist" class="label">Artist:</label>
              <input type="text" id="new_artist" name="new_artist" value="{{$artist->artist}}" required>
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
              <li style="text-align: left;">{{ $song->title }}</li>
            @endforeach
          </ul>
        </div>
      </section>

      <a href="{{ route('artists')}}"><button class="button">Close</button></a>
      <a><button onclick="delete_artist({{ $artist->id }})" class="button">Delete</button></a>
    </main>
  </body>
@endsection