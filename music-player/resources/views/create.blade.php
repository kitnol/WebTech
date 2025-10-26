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
                <h2>New user:</h2>
                <form action="{{ route('create.post') }}" method="POST">
                    @csrf <!-- you should include a hidden CSRF token field in the form so that the CSRF protection middleware can validate the request. You may use the @csrf Blade directive to generate the token field-->
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
                    </fieldset>
                    <button type="submit" value="Create" id="createbutton" class="submitbutton">Create</button>
                </form>
            </div>
        </main>
    </body>

    </html>
@endsection