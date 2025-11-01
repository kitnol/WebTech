<header class="header">
    <h1>d-_-b Music Player</h1>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="@if(request()->routeIs('home')) active @endif">Home</a>
        <a href="{{ route('tracks') }}" class="@if(request()->routeIs('tracks')) active @endif">Tracks</a>
        <a href="{{ route('artists') }}" class="@if(request()->routeIs('artists')) active @endif">Artists</a>
        <a href="{{ route('newtrack') }}" class="@if(request()->routeIs('newtrack')) active @endif">Add new</a>
        <a href="{{ route('profile') }}" class="@if(request()->routeIs('profile')) active @endif">Profile</a>
        
        @auth
            <a href="{{ route('logout') }}" >Logout</a>
        @else
            <a href="{{ route('login') }}" class="@if(request()->routeIs('login')) active @endif">Login</a>
            <a href="{{ route('create') }}" class="@if(request()->routeIs('create')) active @endif">Create</a>

        @endauth
    </nav>
</header> 