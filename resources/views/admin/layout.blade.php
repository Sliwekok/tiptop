<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>Panel administratora - Sarz.pl</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/admin.css')}}" type="text/css" rel="stylesheet" media="all"/>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav ml-auto mr-auto">
            <li class="nav-item @if(Request::is('admin')) active @endif">
                <a class="nav-link" href="{{url('admin/')}}">Panel główny</a>
            </li>
            <li class="nav-item dropdown @if(Request::is('admin/users')) active @endif">
                <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-toggle="dropdown">
                    Użytkownicy
                </a>
                <div class="dropdown-menu" aria-labelledby="usersDropdown">
                    <a class="dropdown-item" href="{{url('admin/users')}}">Lista użytkowników</a>
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="app-content">
    @yield('content')
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="made-with-love">Made with <i class="fa fa-heart"></i> to animals!</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{url('/')}}"><img src="{{asset('images/logo2.svg')}}" alt="sarz-logo"/></a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var baseUrl = "{!!url('/')!!}";
</script>

<script src="{{asset('js/admin.js')}}"></script>

<script>
    $(document).ready(function () {
        $('*[data-toggle="tooltip"]').tooltip();
    });
</script>

</body>
</html>