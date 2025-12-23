<header class="header">
    <h1>d-_-b Music Player</h1>
    <nav class="navbar">  
        @auth
            <a href="{{ route('home') }}" class="@if(request()->routeIs('home')) active @endif" onclick="fadeOutAndNavigate(event, this.href)">Home</a>
            <a href="{{ route('tracks') }}" class="@if(request()->routeIs('tracks')) active @endif" onclick="fadeOutAndNavigate(event, this.href)">Tracks</a>
            <a href="{{ route('artists') }}" class="@if(request()->routeIs('artists')) active @endif" onclick="fadeOutAndNavigate(event, this.href)">Artists</a>
            <a href="{{ route('newtrack') }}" class="@if(request()->routeIs('newtrack')) active @endif" onclick="fadeOutAndNavigate(event, this.href)">Add new</a>
            <a href="{{ route('profile') }}" class="@if(request()->routeIs('profile')) active @endif" onclick="fadeOutAndNavigate(event, this.href)">Profile</a>
            <a href="{{ route('logout') }}" onclick="fadeOutAndNavigate(event, this.href)">Logout</a>
        @else
            <a href="{{ route('demo') }}" class="@if(request()->routeIs('demo')) active @endif" onclick="fadeOutAndNavigate(event, this.href)">Demo</a>        
            <a href="{{ route('aboutus') }}" class="@if(request()->routeIs('aboutus')) active @endif" onclick="fadeOutAndNavigate(event, this.href)">About us</a>      
            <a href="{{ route('login') }}" class="@if(request()->routeIs('login')) active @endif" onclick="fadeOutAndNavigate(event, this.href)">Login</a>
            <a href="{{ route('create') }}" class="@if(request()->routeIs('create')) active @endif" onclick="fadeOutAndNavigate(event, this.href)">Create</a>
        @endauth
    </nav>
    <script src="{{ asset('js/events.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/fadein.css') }}">
</header> 