@extends('layout')
@section('title', 'Login')
@section('content')
    <head>
        <link rel="stylesheet" href="{{ asset('css/login_styles.css') }}">
    </head>
    <body>
        <main>
            <!--display error messages-->
            <div class="mt-6">
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
            <div class="login-container">
                <h2>Login!</h2>
                <form action="{{route('login.post')}}" method="POST"> 
                    @csrf
                    <fieldset>
                        <br>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required><br>
                        <br>
                    </fieldset>
                    <br>
                    <button type="submit" value="Login" id="login-button" class="submitbutton">Login</button>
                </form>
                
                <br>
                <p class="link">
                    <a href="{{ route('create') }}">Create a new user instead</a>
                </p>
            </div>

            <script src="{{ asset('js/login.js') }}"></script>
        </main>
        </body>
@endsection