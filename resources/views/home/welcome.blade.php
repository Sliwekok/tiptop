@extends('layout')

@section('content')

    <div class="home-page">
        <div class="welcome-wrapper">
            <h1>Społeczna Akcja Ratowania Zwierząt</h1>
            <h3>W pełni darmowa aplikacja z bazą danych zaginionych oraz znalezionych zwierząt.</h3>
            <div class="links">
                <a href="{{url('/zaginiony-zwierzak')}}" title="Od czego zacząć gdy nasz zwierzak zaginie?">Zaginiony zwierzak</a>
                <a href="{{url('/znaleziony-zwierzak')}}" title="Od czego zacząć gdy znajdziemy zwierzaka?">Znaleziony zwierzak</a>
            </div>
        </div>
    </div>

@endsection