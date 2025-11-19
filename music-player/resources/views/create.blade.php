@extends('layout')
@section('title', 'Registration')
@section('content')

    <head>
        <link rel="stylesheet" href="{{ asset('css/create_styles.css') }}">
    </head>

    <body>
        <main>
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

            <div class="create-container">
                <h2>New user!</h2>
                <p class="guidetext">Welcome! Are you ready to listen to your favorite songs? Then lets start by creating a
                    new account. d^_^b</p>

                <!-- Old Design Version -->
                <!-- <form action="{{ route('create.post') }}" method="POST">
                            @csrf 

                            <fieldset>
                                <br>
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" minlength="5" required><br><br>
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required><br><br>
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                    required><br><br>
                            </fieldset> -->

                <!-- New Design version: -->

                <article class="card">
                    <form action="{{ route('create.post') }}" method="POST">
                        @csrf
                        <div class="card-info">
                            <!-- Username -->
                            <div class="info-row" id="username">
                                <label class="label">Username:</label>
                                <input type="text" id="username" name="username" minlength="5" required>
                            </div>
                            <!-- Email -->
                            <div class="info-row" id="email">
                                <label class="label">Email:</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <!-- Password -->
                            <div class="info-row" id="password">
                                <label class="label">Password:</label>
                                <input type="password" id="password" name="password"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                    required>
                            </div>
                        </div>
                </article>
                <br>
                <button type="submit" value="Create" id="createbutton" class="submitbutton">Create</button>
                </form>
            </div>
        </main>
    </body>

    </html>
@endsection