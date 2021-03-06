<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This An Instagram Clone">
    <title>Instagram</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header class="header">
        <nav class="nav-bar">
            <div class="nav-brand">
                <a href="/">
                    <img src="{{ asset('img/logo.png') }}" alt="logo">
                </a>
            </div>
            @auth
                <ul class="nav-links">
                    <li class="nav-item">
                        <form action="" method="post" class="form-item">
                            @csrf
                            <input type="search" name="search" id="search" placeholder="Search">
                        </form>
                    </li>
                </ul>
                <ul class="nav-links">
                    <li class="nav-item">
                        <a href="/">
                            <svg aria-label="Home" class="_8-yf5 " fill="#262626" height="22" viewBox="0 0 48 48" width="22"><path d="M45.5 48H30.1c-.8 0-1.5-.7-1.5-1.5V34.2c0-2.6-2.1-4.6-4.6-4.6s-4.6 2.1-4.6 4.6v12.3c0 .8-.7 1.5-1.5 1.5H2.5c-.8 0-1.5-.7-1.5-1.5V23c0-.4.2-.8.4-1.1L22.9.4c.6-.6 1.6-.6 2.1 0l21.5 21.5c.3.3.4.7.4 1.1v23.5c.1.8-.6 1.5-1.4 1.5z"></path></svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <svg aria-label="Direct" class="_8-yf5 " fill="#262626" height="22" viewBox="0 0 48 48" width="22"><path d="M47.8 3.8c-.3-.5-.8-.8-1.3-.8h-45C.9 3.1.3 3.5.1 4S0 5.2.4 5.7l15.9 15.6 5.5 22.6c.1.6.6 1 1.2 1.1h.2c.5 0 1-.3 1.3-.7l23.2-39c.4-.4.4-1 .1-1.5zM5.2 6.1h35.5L18 18.7 5.2 6.1zm18.7 33.6l-4.4-18.4L42.4 8.6 23.9 39.7z"></path></svg>
                        </a>
                    </li>
                    <li class="add_post nav-item">
                        <a href="{{ route('post') }}">+</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <svg aria-label="Activity Feed" class="_8-yf5 " fill="#262626" height="22" viewBox="0 0 48 48" width="22"><path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg>
                        </a>
                    </li>
                    <li class="nav-item sub-links-container">
                        <button id="profile_menu">
                            <img src="{{asset('/storage/'.(substr(auth()->user()->image,7)))}}" alt="profile_img">
                        </button>
                        <ul class="sub-nav-links">
                            <li class="nav-item">
                                <a href="{{route('users',auth()->user()->username)}}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="">Settings</a>
                            </li>
                            <li class="nav-item nav-form">
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <input type="submit" value="Logout">
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth
            @guest
                <ul class="nav-links">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="auth-link">Login</a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{ route('register') }}" class="auth-link">Register</a>
                    </li>
                </ul>
            @endguest
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <script src="{{ asset('js/app.js') }}" type="module"></script>
</body>
</html>
