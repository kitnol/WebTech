@extends('layout')
@section('title', 'Profile')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/profile_styles.css') }}">
    </head>

    <body>
        <main>
            <h2>Your d-_-b Change email address</h2>
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
            <p class="guidetext">Here you can change your email address!</p>
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
                <form action="{{ route('editemail.post') }}" method="POST">
                    @csrf
                        <label class="label">Change your E-mail</label>
                        <div class="info-row">
                            <label for="email" class="label">New E-mail:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <button type="submit" class="button">Update E-mail</button>
                </form>
            </article>
            <a href="{{ route('profile')}}"><button class="button">Back</button></a>
        </main>
    </body>
@endsection