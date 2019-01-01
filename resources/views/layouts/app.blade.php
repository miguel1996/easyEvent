<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>easyEvent</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!--adiciona o ícone da casa-->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
    <div id="app">

        @auth
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <a id="home-button" class="navbar-brand" href="{{ url('/') }}">
                <i class="fa fa-home"></i> Home
            </a>
            <a id="all-events-button" class="navbar-brand" href="/events">All Events</a>
            <a id="subs-button" class="navbar-brand" href="/subscriptions">Subscriptions</a>
            @if (strcmp(Auth::user()->group->name,"member") != 0)  
            <a id="my-events-button" class="navbar-brand" href="/user/events">Event Management</a>     
            @if (strcmp(Auth::user()->group->name,"admin") == 0)         
            <a id="admin-button" class="navbar-brand" href="/admin">Admin</a>
        @endif
        @endif
        @guest
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->

            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
                @if (Route::has('register'))
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </li>
        </ul>
        @else
        {{Session::get('status')}}

        <div style="float:right" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ Auth::user()->name }}({{ Auth::user()->group->name }}) {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div> 
    @endguest
</nav>
@endauth
<main class="py-4">
    @yield('content')
</main>
</div>
    <!-- if you want to put a js script start with for example:
    @section('scripts')
        <script src="{{asset('js/scripts/events.js')}}"></script>
    @stop
-->
@yield('scripts')
</body>
</html>
