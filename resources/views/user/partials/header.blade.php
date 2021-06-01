<div class="user-header mt-5">
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-xl-7 col-lg-8 col-md-12 col-xs-12">
                <div class="wrapper">
                    {{--<div><img class="rounded-circle" src="http://via.placeholder.com/130x130" /></div>--}}
                    <div>
                        <h3>{{Auth::user()->name}}</h3>
                        <ul>
                            <li><a class="{{ Request::is('konto') ? 'active' : '' }}" href="{{url('konto')}}">Ogłoszenia</a></li>
                            <li><a class="{{ Request::is('konto/wiadomosci') ? 'active' : '' }}" href="{{url('konto/wiadomosci')}}">Wiadomości ({{$unreadMessages}})</a></li>
                            <li><a class="{{ Request::is('konto/ustawienia') ? 'active' : '' }}" href="{{url('konto/ustawienia')}}">Ustawienia</a></li>
                            <li><a href="{{url('wyloguj')}}">Wyloguj</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>