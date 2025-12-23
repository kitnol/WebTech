@extends('layout')
@section('title', 'Profile')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/profile_styles.css') }}">
        <script src="{{ asset('js/profile.js') }}"></script>
    </head>

    <body>
        <main>
            <div id="top-info">
                <h2>Your d-_-b Profile</h2>
                <p class="guidetext">All your info in the right place!</p>
                <!--display error messages-->
                <div class="mt-5">
                    @if($errors->any()) <!--check for errors-->
                        <div class="col-12">
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                </div>
            </div>
            <!-- Start of card -->
            <article class="card" id="card-container">
                <div class="card-info">
                    <!-- Profile picture -->
                    <img src="https://img.freepik.com/premium-photo/headphones-with-music-notes-headband-purple-background_1204450-18446.jpg" alt="Immagine musicale" class="profile-image"> 
                    <!-- Username info -->
                    <div class="info-row" id="username-row">
                        <span class="label">Username:</span>
                        <!-- Username info -->
                        <div id="username-info">
                            <span class="value">{{auth()->user()->username}}</span>
                        </div>
                        <!-- Username edit -->
                        <div class="hidden" id="username-edit">
                            <form action="{{ route('editprofile.post') }}" method="POST">
                            @csrf
                                <div>
                                    <input type="text" id="username" name="username" value="{{auth()->user()->username}}" required>
                                    <button type="submit" class="button">✔</button>
                                </div>
                            </form>
                        </div>
                        <a href="javascript:editUsername()" id="username-button"><button class="button">&#9998;</button></a>
                        
                    </div>
                    <!-- Email info -->
                    <div class="info-row" id="emailname-row">
                        <span class="label">E-mail:</span>
                        <div id="emailname-info">
                            <span class="value">{{auth()->user()->email}}</span>
                        </div>
                        <div class="hidden" id="emailname-edit">
                            <form action="{{ route('editemail.post') }}" method="POST">
                                @csrf
                                    <div>
                                        <input type="email" id="email" name="email" value="{{auth()->user()->email}}" required>
                                        <button type="submit" class="button">✔</button>
                                    </div>
                            </form>
                        </div>
                        <a href="javascript:editEmail()" id="email-button"><button class="button">&#9998;</button></a>
                        
                    </div>                    
                    <!-- Password info -->
                    <div class="info-row" id="passowrd-info">
                        <span class="label">Password:</span>
                        <span class="value">********</span>
                        <a href="{{ route('passedit') }}"><button class="button" id="pass-button">&#9998;</button></a>
                    </div>
                    <!-- Joined since info -->
                    <div class="info-row">
                        <span class="label">Joined since:</span>
                        <span class="value">{{ auth()->user()->created_at->format('F j, Y') }}</span>
                    </div>
                    <!-- Songs saved info -->
                    <div class="info-row">
                        <span class="label">Songs saved:</span>
                        <span class="value">{{auth()->user()->songs->count()}}</span>
                    </div>
                </div>
            </article>     
        </main>
    </body>
@endsection