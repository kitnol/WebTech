@extends('layout')
@section('title', 'Edit Artist')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/profile_styles.css') }}">
    </head>

    <body>
        <main>
            <h2> d-_-b Change Artist information</h2>
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
            <p class="guidetext">Here you can change the artist name</p>
            <article class="card">
                <div class="card-info">
                    <div class="info-row">
                        <span class="label">Current artist name:</span>
                        <span class="value">{{ $artist }}</span>
                    </div>
                <form action="{{ route('editartist.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="current_artist" value="{{ $artist }}">    
                    <label class="label">Change the artist name:</label>
                        <div class="info-row">
                        <label for="new_artist" class="label">New artist name:</label>
                        <input type="text" id="new_artist" name="new_artist" required>
                        </div>
                        <button type="submit" class="button">Update artist name</button>
                </form>
            </article>
            <a href="{{ route('artistinfo', ['artist' => $artist]) }}"><button class="button">Back</button></a>
        </main>
    </body>
@endsection