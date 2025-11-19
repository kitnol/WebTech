@extends('layout')
@section('title', 'Passedit')
@section('content')

    <head>
        <link rel="stylesheet" href="{{ asset('css/passedit_styles.css') }}">
        <script src="{{ asset('js/passedit.js') }}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- This is for checking the current pass before changes -->
    </head>

    <body>
        <main>
            <h2>d-_-b Password Edit!</h2>
            <p class="guidetext">Change your private password!</p>
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
                    <!-- Username info -->
                    <div class="info-row" id="username-info">
                        <label class="label">Username:</label>
                        <input type="text" value="{{ auth()->user()->username }}" disabled>
                    </div>
                    <!-- Edit Password -->
                    <form action="{{ route('changepassword.post') }}" method="POST"> <!-- This now works -->
                        @csrf
                        <!-- Current Password -->
                        <div class="info-row">
                            <label for="current_password" class="label">Current Password:</label>
                            <!-- small wrapper to show the error message under the input box -->
                            <div class="input-wrapper">
                                <input type="password" id="current_password" name="current_password" required>
                                <!-- Error message in case of wrong original pass -->
                                <div id="inline-error" class="inline-error"></div>
                            </div>
                        </div>
                        <!-- New Password -->
                        <div class="info-row">
                            <label for="new_password" class="label">New Password:</label>
                            <input type="password" id="new_password" name="new_password" required>
                        </div>
                        <!-- Confirm New Password -->
                        <div class="info-row">
                            <label for="new_password_confirmation" class="label">Confirm New Password:</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>

                        <div class="button-row">
                            <!-- Save Button -->
                            <button type="submit" class="button">Save Password</button>
                            <!-- Close Button -->
                            <a href="{{ route('profile')}}"><button class="button">Close</button></a>
                    </form>
                </div>
            </article>
        </main>
    </body>
@endsection