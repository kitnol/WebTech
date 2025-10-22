<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Results</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
    <h1>User Details Submitted</h1>

    <p>Name: {{ $name }}</p>
    <p>Email: {{ $email }}</p>

    <a href="{{ route('users.create') }}">Go back to form</a>
</body>
</html>