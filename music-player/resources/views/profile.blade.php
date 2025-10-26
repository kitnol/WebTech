@extends('layout')
@section('title', 'Profile')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/profile_styles.css') }}">
    </head>

    <body>
        <main>
            <h2>Your d-_-b Profile</h2>
            <p>
                All your info in the right place!
            </p>
            <article class="card">
                <div class="card-info">
                    <div class="info-row">
                        <span class="label">Username:</span>
                        <span class="value">{{auth()->user()->username}}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">E-mail:</span>
                        <span class="value">{{auth()->user()->email}}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Joined since:</span>
                        <span class="value">{{ auth()->user()->created_at->format('F j, Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Songs saved:</span>
                        <span class="value">156</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Total listening hours:</span>
                        <span class="value">200</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Most Listened Song:</span>
                        <span class="value">Crab Rave</span>
                    </div>
                </div>
                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.pinimg.com%2F474x%2F59%2F1a%2Fab%2F591aabea9f41760593c8b3d86cc9d0af.jpg%3Fnii%3Dt&f=1&nofb=1&ipt=29e3ae791a9a6f16f9b234f998f3cdf98df02f45df8cb6b61fb091d04244dd8d"
                    alt="User profile picture">
            </article>
        </main>
    </body>
@endsection