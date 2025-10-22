<!DOCTYPE html>
<html>
<head>
    <title>User Form</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Create New User</h1>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf <!-- you should include a hidden CSRF token field in the form so that the CSRF protection middleware can validate the request. You may use the @csrf Blade directive to generate the token field-->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>