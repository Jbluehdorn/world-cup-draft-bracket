<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Completely Unprepared World Cup Bracket</title>
</head>
<body>
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('logout') }}">Logout</a>
            @else
                <a href="{{ route('login') }}">Login/Signup</a>
            @endauth
        </div>
    @endif

    @if(Auth::user())
        User: {{Auth::user()->name ? Auth::user()->name : Auth::user()->email}}
    @endif

    @yield('content')
</body>
</html>