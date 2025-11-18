@extends('layout')
@section('title', 'About us')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('/css/about_styles.css') }}">
    </head>

    <body>
        <main>
            <section class="grid">
            <h2>About us! d-_-b</h2>    
            <article class="card">
                    <p>
                        Welcome! 
                        <br><br>
                        We are five Mechatronics students, building a website!
                        <br><br>
                        This project is part of the Web Technologies course 2025 at SDU!
                        <br><br>
                        We have poured our imagination and creativity in this project, aiming to create something of our own.
                        This website reflects our own needs and desires for a music player: simplicity, customisability, and song ownership!
                        This is why we want you to have full control over your music library, by allowing you to upload your own songs and artist data.
                        <br><br>
                        Please, make yourself at home!

                    </p>
                </article>
        </main>
    </body>
@endsection