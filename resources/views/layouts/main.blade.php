<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Completely Unprepared World Cup Bracket</title>

    <link rel="icon" type="image/png" href="images/logo.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    {{-- @if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ route('logout') }}">Logout</a>
        @else
            <a href="{{ route('login') }}">Login/Signup</a>
        @endauth
    </div>
    @endif --}}

    <div id="app">
        @yield('content')
    </div>

    <script>
        window.user = {!! Auth::User() !!}
    </script>
    <script src="{{mix('js/app.js')}}"></script>
</body>
</html>