@extends('layout')

@section('content')

    <div class="lost-found-guide">

        <div class="heading">
            <h3>Zgłoś Znalezionego Zwierzaka</h3>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="guide-text">
                        <p>Znalazłeś zbłąkanego zwierzaka, bardzo chcesz pomóc odnaleźć jego dom, ale nie wiesz co dalej? Spokojnie, jesteś we właściwym miejscu! Dodaj zdjęcie oraz opis
                            zwierzęcia, które znalazłeś. Postaraj się określić jaka jest sytuacja zwierzęcia – czy jest chore, znaki szczególne, gdzie przebywa*.</p>

                        <p>Gdy dodasz ogłoszenie, to nasza aplikacja sprawdzi, czy nikt nie szuka zguby w okolicy której został znaleziony. Co jeżeli system nie znajdzie pasujących wyników
                            od razu? Nic się nie dzieje – po prostu aplikacja będzie szukać ponownie, aż do momentu, gdy usuniesz ogłoszenie, bądź właściciel zostanie odnaleziony.</p>

                        <p>*pamiętaj, aby niezwłocznie udzielić pomocy rannemu zwierzęciu, oraz aby go zabezpieczyć.</p>
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