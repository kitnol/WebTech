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
            <article class="card">
                <div class="card-info">
                    <div class="info-row" id="username-info">
                        <span class="label">Username:</span>
                        <span class="value">{{auth()->user()->username}}</span>
                        <a href="javascript:editUsername()"><button class="button">&#9998;</button></a>
                    </div>
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

                    <div class="info-row" id="emailname-info">
                        <span class="label">E-mail:</span>
                        <span class="value">{{auth()->user()->email}}</span>
                        <a href="javascript:editEmail()"><button class="button">&#9998;</button></a>
                    </div>
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
                    <div class="info-row">
                        <span class="label">Joined since:</span>
                        <span class="value">{{ auth()->user()->created_at->format('F j, Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Songs saved:</span>
                        <span class="value">{{auth()->user()->songs->count()}}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Total listening hours:</span>
                        <span class="value">NOT WORKING</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Most Listened Song:</span>
                        <span class="value">NOT WORKING</span>
                    </div>
                </div>
                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.pinimg.com%2F474x%2F59%2F1a%2Fab%2F591aabea9f41760593c8b3d86cc9d0af.jpg%3Fnii%3Dt&f=1&nofb=1&ipt=29e3ae791a9a6f16f9b234f998f3cdf98df02f45df8cb6b61fb091d04244dd8d"
                    alt="User profile picture">
            </article>
            
        </main>
    </body>
@endsection