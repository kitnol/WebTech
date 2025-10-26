<header class="header">
    <h1>d-_-b Music Player</h1>
    <nav class="navbar">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('tracks') }}">Tracks</a>
        <a href="{{ route('artists') }}">Artists</a>
        <a href="{{ route('newtrack') }}">Add new</a>
        <a href="{{ route('profile') }}">Profile</a>
        
        @auth
            <a href="{{ route('logout') }}">Logout</a>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('create') }}">Create</a>

        @endauth
    </nav>
</header> 