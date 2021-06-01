@extends('layout')

@section('content')

    <div class="lost-found-guide">

        <div class="heading">
            <h3>Zgłoś Zaginionego Zwierzaka</h3>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="guide-text">

                        <p>W takich chwilach ważna jest każda minuta, tak aby informacja dotarła do jak największej liczby osób. Gdy działamy szybko jego szanse na odnalezienie są duże.
                        Dlatego stworzyliśmy całkowicie innowacyjną aplikację SARZ.PL, która jest całkowicie za darmo, a jej cel jest jeden – pomóc bezpiecznie wrócić zaginionym zwierzętom do ich właścicieli.
                        Kiedy tylko dodasz ogłoszenie, użytkownicy, którzy mieszkają w pobliżu miejsca zaginięcia zwierzęcia zostaną o tym powiadomieni – Ty także zostaniesz powiadomiony, jeżeli zostanie dodane ogłoszenie o zaginionym futrzastym członku rodziny.
                            Zarejestrowani użytkownicy mogą się bezpiecznie komunikować ze sobą za pomocą wbudowanego systemu wiadomości. Jeżeli w ogłoszenie dodasz swój numer telefonu, to mogą do Ciebie oddzwonić – nie jest to jednak wymóg, sam zdecydujesz jakie dane chcesz podać.</p>

                        <p>Nie zwlekaj i dodaj ogłoszenie już teraz, każda minuta jest na wagę złota!</p>

                    </div>

                    <div class="buttons">
                        @guest
                            <div class="alert alert-warning mt-3">Aby dodać ogłoszenie musisz się zalogować.</div>
                            <button class="btn btn-warning btn-lg mr-2" data-ref="ogloszenie/dodaj" data-toggle="modal" data-target="#loginModal">ZALOGUJ SIĘ</button>
                            <button class="btn btn-outline-dark btn-lg" data-ref="ogloszenie/dodaj" data-toggle="modal" data-target="#registerModal">ZAREJESTRUJ SIĘ</button>
                        @else
                            <a class="btn btn-warning btn-lg" href="{{url('/ogloszenie/dodaj')}}">DODAJ OGŁOSZENIE</a>
                        @endguest
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection