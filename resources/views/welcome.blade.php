<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>easyEvent</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">My Profile</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                easyEvent
            </div>
            @if (Route::has('login'))
                @auth
                <div class="links">
                    <a href="/events">All Events</a>
                    <a href="https://laracasts.com">My Events</a>
                    <a href="/subscriptions">Subscriptions</a>
                    <a href="https://nova.laravel.com">Admin</a>
                </div>
                @endauth
            @endif
        </div>
    </div>
    <div id="events">
        @for ($i = 0; $i < 5; $i++)
            <div class="flex-center position-ref">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Title</div>
                        <div class="card-body">
                            <p>Description: </p>
                            <p>Image: </p>
                            <p>Date: </p>
                            <p>Sign In </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endfor
    </div>
</body>
</html>
