@extends('layout')
@section('title', 'Registration')
@section('content')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <div id="top-info">
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
                </div>
                <div id="card-container">
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
            </div>
        </main>
        <script>
            function fadeIn(container,start,length){
                if (container) {
                    container.style.opacity = '0';
                    container.style.transform = 'translateY(50px)';
                    container.style.transition = 'opacity '+length+'s ease-out, transform '+length+'s ease-out';
                    // make animation after a the start delay
                    setTimeout(() => {
                        container.style.opacity = '1';
                        container.style.transform = 'translateY(0)';
                    }, start);
                }
            }
            function fadeOut(container, length) {
                if (container) {
                    container.style.transition = 'opacity ' + length + 's ease-out, transform ' + length + 's ease-out';
                    container.style.opacity = '0';
                    container.style.transform = 'translateY(50px)';
                }
            }
            document.addEventListener('DOMContentLoaded', function () {
                const topinfo = document.getElementById('top-info');
                const container = document.getElementById('card-container');
                fadeIn(topinfo,100,0.3);
                fadeIn(container,300,0.3);

                // Handle form submission with AJAX to avoid full page reload on wrong credentials and do the animation instead
                const form = document.querySelector('form');
                if (form) {
                    form.addEventListener('submit', async function(ev) {
                        ev.preventDefault();
                        const formData = new FormData(form);
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                        try {
                            const response = await fetch(form.action, {method: 'POST',body: formData,headers: {'X-CSRF-TOKEN': csrfToken,'Accept': 'application/json'}});
                            if (response.ok) { // create ok go login
                                const data = await response.json();
                                const successDiv = document.createElement('div');
                                successDiv.className = 'alert alert-success';
                                successDiv.textContent = data.success;
                                document.querySelector('main').prepend(successDiv);
                                setTimeout(() => {
                                    fadeOut(container,0.3);
                                }, 600);
                                setTimeout(() => {
                                    fadeOut(topinfo,0.3);
                                }, 800);
                                setTimeout(() => {
                                    window.location.href = data.redirect;
                                }, 1000);
                            } else { // create is not okay do the shake animation or sth...
                                const errorData = await response.json();
                                let errorMessage = 'Registration failed';
                                if (errorData.errors) {
                                    errorMessage = Object.values(errorData.errors).flat().join(' ');
                                }
                                // delete any previous alerts so we do not get stacking invalid details alert on top that looks ugly
                                const existingAlerts = document.querySelectorAll('.alert');
                                existingAlerts.forEach(alert => alert.remove());
                                // show text at top that details are invalid  - alert
                                const alertDiv = document.createElement('div');
                                alertDiv.className = 'alert alert-danger';
                                alertDiv.textContent = errorMessage;
                                document.querySelector('main').prepend(alertDiv);
                                // do the shake animation
                                form.classList.add('shake');
                                setTimeout(() => {
                                    form.classList.remove('shake');
                                }, 500);
                            }
                        } catch (error) { // other errors
                            console.error('Create error:', error);
                            const alertDiv = document.createElement('div');
                            alertDiv.className = 'alert alert-danger';
                            alertDiv.textContent = 'An error occurred. Please try again.';
                            document.querySelector('main').prepend(alertDiv);
                            // do the shake animation
                            form.classList.add('shake');
                            setTimeout(() => {
                                form.classList.remove('shake');
                            }, 500);
                        }
                    });
                }
            });
        </script>
    </body>

    </html>
@endsection