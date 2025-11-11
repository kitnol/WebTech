@extends('layout')
@section('title', 'Passedit')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/passedit_styles.css') }}">
        <script src="{{ asset('js/passedit.js') }}"></script>
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
                        <span class="label">Username:</span>
                        <span class="value">{{auth()->user()->username}}</span>
                    </div>
                    <!-- Edit Password -->
                    <div class="info-row">
                        <form action="{{ route('changepassword.post') }}" method="POST"> <!-- !!!!!!Add this route -->
                            @csrf
                                <!-- Current Password -->
                                <div class="info-row">
                                    <label for="current_password" class="label">Current Password:</label>
                                    <input type="password" id="current_password" name="current_password" required>
                                </div>
                                <!-- New Password -->
                                <div class="info-row">
                                    <label for="new_password" class="label">New Password:</label>
                                    <input type="password" id="new_password" name="new_password" required>
                                </div>
                                <!-- Confirm New Password -->
                                <div class="info-row">
                                    <label for="new_password_confirmation" class="label">Confirm New Password:</label>
                                    <input type="text" id="new_password_confirmation" name="new_password_confirmation" required>
                                </div>
                                <!-- Save Button -->
                                <button type="submit" class="button">Save Password</button>
                        </form>
                    </div>
                    <a href="{{ route('profile')}}"><button class="button">Close</button></a> 
                </div>
            </article>
            
        </main>
    </body>
@endsection