@extends('layout')
@section('title', 'Demo')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/demo_styles.css') }}">
    </head>
    <main class="main">
        <div class="main-left">
            <div class="hero-image">
                <h1 class="hero-text" style="margin-left: 50px;">Demo Page d-_-b </h1>
                <p class="demotext">To access the functionalities <a href="{{ route('login') }}">Login</a> or <a href="{{ route('create') }}">Create</a> an account. <br> You can also learn more <a href="{{ route('aboutus') }}">about us</a>.</p>
            </div>
            <div class="song-list">
                <section class="title" style="margin-left: 10px;">
                    <h2>Track list:</h2>
                </section>
                <div class="scrollable">
                    <section class="cards-grid">
                        <article class="card">
                            <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
                            <p>Artist 1 - Track 1 </p>
                        </article>
                        <article class="card">
                            <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>                                
                            <p>Artist 2 - Track 2 </p>
                        </article>
                        <article class="card">
                            <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>
                            <p>Artist 3 - Track 3 </p>
                        </article>
                        <article class="card">
                            <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>                                
                            <p>Artist 4 - Track 4 </p>
                        </article>
                        <article class="card">
                            <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>                                
                            <p>Artist 5 - Track 5 </p>
                        </article>
                        <article class="card">
                            <button onclick="player.play()"><i id="playBt" class="fa fa-play"></i></button>                                
                            <p>Artist 6 - Track 6 </p>
                        </article>
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
                            <p> Title: Track 2</p>
                            <p > Artist: Artist 3</p>
                        </div>
                        <audio id="audio" src=""></audio>
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
@endsection