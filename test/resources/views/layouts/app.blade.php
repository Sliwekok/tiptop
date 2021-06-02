<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>To-do strona</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="row">
    <nav class="col-12">
        <div class="col-4 logo"><h2>To-do</h2></div>
        <div class="col-8 navItems">
            <div class="col-3 offset-5 navItem"><a href="{{url('/')}}"><div class="col-12">Twoje konto</div></a></div>
            <div class="col-2 navItem"><a href="{{url('login')}}"><div class="col-12">Zaloguj się</div></a></div>
            <div class="col-2 navItem"><a href="{{url('register')}}"><div class="col-12">Rejestracja</div></a></div>
        </div>
    </nav>
</div>    
<div class="row">
    <main class="col-12">
        @yield('content')
    </main>
</div>
</body>
</html>
