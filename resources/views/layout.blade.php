<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>Społeczna Akcja Ratowania Zwierząt - Sarz.pl</title>
    @stack('facebook-meta')
    @if(!Request::is('ogloszenie/szczegoly/*'))
        @include('partials.facebook-meta')
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" type="text/css" rel="stylesheet" media="all"/>
    @stack('head-scripts')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">

    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('images/logo2.svg')}}" alt="logo"/></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/')}}">Strona główna</a>
                </li>
                <li class="nav-item {{ Request::is('zaginione-znalezione*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('zaginione-znalezione')}}">Zwierzęta</a>
                </li>
                @auth
                    <li class="nav-item {{ Request::is('konto*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{url('konto')}}">Konto @if($unreadMessages > 0) <span class="account-notifications-counter">{{$unreadMessages}}</span> @endif</a>
                    </li>
                    <li class="nav-item {{ Request::is('ogloszenie/dodaj') ? 'active' : '' }}">
                        <a class="nav-link nav-btn" href="{{url('ogloszenie/dodaj')}}">Dodaj ogłoszenie</a>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-ref="/" data-target="#loginModal">Zaloguj</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-btn" href="#" data-ref="ogloszenie/dodaj" data-toggle="modal" data-target="#loginModal">Dodaj ogłoszenie</a>
                    </li>
                @endguest
            </ul>
        </div>

    </div>
</nav>

<div class="app-content">
    @yield('content')
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul>
                    <li><a href="{{url('regulamin')}}">Regulamin</a></li>
                    <li><a href="{{url('polityka-prywatnosci')}}">Polityka prywatności</a></li>
                    <li><a href="{{url('wspolpraca')}}">Współpraca</a></li>
                    <li><a href="{{url('kontakt')}}">Kontakt</a></li>
                </ul>
            </div>
        </div>
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

<div id="cookies" class="cookies">
    <div class="text">Ta witryna korzysta z plików cookie. Możesz wyłączyć ten mechanizm w ustawieniach przeglądarki. Więcej informacji na ten temat znajdziesz w naszej polityce prywatności.</div>
    <div class="buttons">
        <button onclick="acceptCookies()" class="btn btn-success">Zamknij</button>
    </div>
</div>

@guest
    @include('modals.login')
    @include('modals.register')
    @include('modals.remind-password')
@endguest

<script type="text/javascript">
    var baseUrl = "{!!url('/')!!}";
</script>

<script src="{{asset('js/app.js')}}"></script>

<script>
    $(document).ready(function () {
        $('*[data-toggle="tooltip"]').tooltip();
    });
</script>
<b>@php echo Session::get('notLoggedIn') @endphp</b>
@if(Session::has('notLoggedIn'))
    <script type="text/javascript">
        $(document).ready(function () {
            var ref = '{!! Session::get('notLoggedIn') !!}', $loginModal = $("#loginModal");
            $loginModal.find('input[name="ref"]').val(ref);
            var fbBtnHref = $loginModal.find('.btn-facebook').attr('href');
            $loginModal.find('.btn-facebook').attr('href', fbBtnHref + '?ref=' + baseUrl + '/' + ref);
            $loginModal.modal();
        });
    </script>
@endif

@include('partials.toast')
@include('modals.alert')

@stack('scripts')

<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '882750211905623',
            autoLogAppEvents: true,
            xfbml: true,
            version: 'v3.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/pl_PL/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122475827-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-122475827-1');
</script>


</body>
</html>