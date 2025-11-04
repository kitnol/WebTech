@extends('layout')
@section('title', 'Home Page')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/home_styles.css') }}">
    </head>

    <body>
        <main class="main">
            <div class="main-left">
                <div class="hero-image">
                    <h1 class="hero-text" style="margin-left: 50px;">Home Page</h1>
                </div>
                <div class="song-list">
                    <section class="title" style="margin-left: 10px;">
                        <h2>Track list:</h2>
                    </section>
                    <div class="scrollable">
                        <section class="cards-grid">
                            @foreach(auth()->user()->songs->pluck('artist')->unique() as $artist)
                                    @php
                                    $songsbyartist = auth()->user()->songs
                                        ->where('artist', $artist)
                                        ->unique('title');
                                    @endphp
                                    @foreach($songsbyartist as $song)
                                        <article class="card">
                                            <button onclick="player.play({{$song->id}})"><i id="playBt{{(string)$song->id}}" class="fa fa-play"></i></button>
                                             <p>{{$song->artist}} - {{$song->title}}</p>
                                        </article>
                                    @endforeach
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
            <div class="main-right">
                <div class="album-art">
                    <img src="https://placehold.co/300x200?text=Album-Picture" class="album-pic" alt="albumpic" >
                </div>
                <div class="player-class">
                    <div></div>
                    <div class="song-info">
                        <h2>Played song:</h2>
                        <div class="track-info">
                            <p id="track-title">Track Title:</p>
                            <p id="track-artist">Track Artist:</p>
                        </div>
                        @foreach(auth()->user()->songs->pluck('file_path_track') as $song_url)
                            @php
                                if($song_url == null)
                                {
                                    continue;
                                }

                            @endphp
                            <audio id="audio" src="storage/{{$song_url}}"></audio>

                            @php
                                if($song_url != null)
                                {
                                    break;
                                }
                            @endphp
                        @endforeach
                    </div>
                    <div></div>
                    <div></div>

                    <div class="progress-container">
                        <div class="progress-circle" id="progressCircle">
                            <img class="track-art" src="{{ asset('pictures/vinyl_PNG18-2327334362.png') }}" alt="Track Art" unselectable="on"
                                style="rotate: 10deg;">
                        </div>
                    </div>
                    <div id="volume">
                        <input class="volume" type="range" min="0" max="1" value="1" step="0.01">
                        <div id="volume-icon">
                            <i class="fa fa-volume-up vol-ico"></i>
                        </div>
                    </div>
                    <div id="timeDisplay">0:00</div>

                    <div class="controls">
                        <button onclick="player.previous()" id="frbk"><i class="fa fa-backward"
                                style="align-items: center;"></i></button>
                        <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
                        <button onclick="player.next()" id="frbk"><i class="fa fa-forward"></i></button>
                    </div>
                    <div class="song-length">0:00</div>
                </div>
            </div>
        </main>


        <script>
                @php

                    $song_id = request('play');

                    $songs_urls = [];
                    foreach(auth()->user()->songs as $song) {
                        if($song->file_path_track != null) {
                            $songs_urls[] = [
                                'title' => $song->title,
                                'artist' => $song->artist,
                                'url' => $song->file_path_track,
                                'id' => $song->id
                            ];
                        }
                    }

                @endphp
                let song_id = {{$song_id ?? 'null'}};
                const tracks = {!! json_encode($songs_urls) !!};
        </script>
        <script src="{{ asset('js/player.js') }}"></script>
        <script>
            const progressCircle = document.getElementById('progressCircle');
            const progressText = document.getElementById('progressText');
            const progressSlider = document.getElementById('progressSlider');

            function setProgress(percentage) {
                // Ensure percentage is between 0 and 100
                percentage = Math.max(0, Math.min(100, percentage));

                // Calculate the angle for the conic gradient
                const angle = (percentage / 100) * 360;

                // Update the conic gradient
                progressCircle.style.background = `conic-gradient(
                    #4CAF50 0deg,
                    #4CAF50 ${angle}deg,
                    #e0e0e0 ${angle}deg
                )`;

                // Update the text
                progressText.textContent = `${Math.round(percentage)}%`;

                // Update slider
                progressSlider.value = percentage;
            }

            // Slider event listener
            progressSlider.addEventListener('input', function () {
                setProgress(this.value);
            });

            // Animate progress function
            function animateProgress() {
                let progress = 0;
                const interval = setInterval(() => {
                    progress += 2;
                    setProgress(progress);

                    if (progress >= 100) {
                        clearInterval(interval);
                    }
                }, 50);
            }

            // Initialize with 0%
            setProgress(0);
        </script>
    </body>

@endsection
