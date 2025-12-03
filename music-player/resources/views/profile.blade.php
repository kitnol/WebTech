@extends('layout')
@section('title', 'Profile')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/profile_styles.css') }}">
        <script src="{{ asset('js/profile.js') }}"></script>
    </head>

    <body>
        <main>
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
            <!-- Start of card -->
            <article class="card">
                <div class="card-info">
                    <!-- Profile picture -->
                    <img src="https://img.freepik.com/premium-photo/headphones-with-music-notes-headband-purple-background_1204450-18446.jpg" alt="Immagine musicale" class="profile-image"> 
                    <!-- Username info -->
                    <div class="info-row" id="username-info">
                        <span class="label">Username:</span>
                        <span class="value">{{auth()->user()->username}}</span>
                        <a href="javascript:editUsername()"><button class="button">&#9998;</button></a>
                    </div>
                    <!-- Edit Username -->
                    <div class="info-row" id="username-edit" style="display:none;">
                        <form action="{{ route('editprofile.post') }}" method="POST">
                            @csrf
                                <div class="info-row">
                                    <label for="username" class="label">Username:</label>
                                    <input type="text" id="username" name="username" value="{{auth()->user()->username}}" required>
                                </div>
                                <button type="submit" class="button">Save username</button>
                        </form>
                        <a href="javascript:cancelUsername()"><button class="button">&#10006;</button></a>
                    </div>
                    <!-- Email info -->
                    <div class="info-row" id="emailname-info">
                        <span class="label">E-mail:</span>
                        <span class="value">{{auth()->user()->email}}</span>
                        <a href="javascript:editEmail()"><button class="button">&#9998;</button></a>
                    </div>
                    <!-- Edit Email -->
                    <div class="info-row" id="emailname-edit" style="display:none;">
                        <form action="{{ route('editemail.post') }}" method="POST">
                            @csrf
                                <div class="info-row">
                                    <label for="email" class="label">E-mail:</label>
                                    <input type="email" id="email" name="email" value="{{auth()->user()->email}}" required>
                                </div>
                                <button type="submit" class="button">Save email</button>
                        </form>
                        <a href="javascript:cancelEmail()"><button class="button">&#10006;</button></a>
                    </div>
                    <!-- Password info -->
                    <div class="info-row" id="passowrd-info">
                        <span class="label">Password:</span>
                        <span class="value">********</span>
                        <a href="{{ route('passedit') }}"><button class="button">&#9998;</button></a>
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
                    <!-- User Type info -->
                    <div class="info-row">
                        <span class="label">User Type:</span>
                        <span class="value">{{ auth()->user()->isPremium() ? 'Premium' : 'Standard' }}</span>
                    </div>
                    <!-- Button to change the user type different based on current role -->
                    <div class="info-row">
                        @if(auth()->check() && !auth()->user()->isPremium())
                            <!-- upgrade to premium -->
                            <form action="{{ route('user.upgrade') }}" method="POST">
                                @csrf
                                <button type="submit" class="button">Become Premium</button>
                            </form>
                            <span class="value">Premium users have access to the exclusive feature of marking their favorite songs and finding them all in one space. Join now!</span>
                        @elseif(auth()->check() && auth()->user()->isPremium())
                            <!-- downgrade to standard user -->
                            <form action="{{ route('user.unsubscribe') }}" method="POST">
                                @csrf
                                <button type="submit" class="button">Unsubscribe</button>
                            </form>
                        @endif
                    </div>
                </div>
            </article>     
        </main>
    </body>
@endsection