@extends('layout')

@section('content')
    <div id="user" class="user-settings">

        @include('user.partials.header')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-12 col-xs-12">
                    <div class="accordion" id="userSettings">

                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#changeUserName">Zmiana nazwy użytkownika</button>
                            </div>
                            <div id="changeUserName" class="collapse show" data-parent="#userSettings">
                                <div class="card-body">
                                    <form method="post" action="{{url('/konto/change-user-name')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nazwa użytkownika</label>
                                            <input type="text" maxlength="64" name="name" placeholder="Wpisz swoją nazwę użytkownika" class="form-control" value="{{Auth::user()->name}}"
                                                   required/>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-warning">Zapisz zmiany</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#changeEmail">Zmiana adresu email</button>
                            </div>
                            <div id="changeEmail" class="collapse" data-parent="#userSettings">
                                <div class="card-body">
                                    <form method="post" action="{{url('/konto/change-user-email')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Adres email</label>
                                            <input type="email" maxlength="128" name="email" placeholder="Wpisz swoją nazwę użytkownika" class="form-control" value="{{Auth::user()->email}}"
                                                   required/>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-warning">Zapisz zmiany</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#changePassword">Zmiana hasła</button>
                            </div>
                            <div id="changePassword" class="collapse" data-parent="#userSettings">
                                <div class="card-body">
                                    <form method="post" action="{{url('/konto/change-password')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Aktualne hasło</label>
                                            <input type="password" name="oldPassword" placeholder="Wpisz swoje aktualne hasło" class="form-control" value="" autocomplete="new-password"
                                                   required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nowe hasło</label>
                                            <input type="password" name="password" placeholder="Wpisz nowe hasło" class="form-control" value="" autocomplete="new-password" required/>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-warning">Zapisz zmiany</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#notifications">Powiadomienia i zgody</button>
                            </div>
                            <div id="notifications" class="collapse" data-parent="#userSettings">
                                <div class="card-body">
                                    <form method="post" action="{{url('/konto/save-notifications-settings')}}">
                                        @csrf
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input @if(Auth::user()->notifications) checked @endif type="checkbox" class="custom-control-input" name="notifications" id="notification">
                                                <label class="custom-control-label" for="notification">Zgadzam się na wysyłanie powiadomień na adres e-mail przypisany do mojego konta.</label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-warning">Zapisz zmiany</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{--<div class="card">--}}
                            {{--<div class="card-header">--}}
                                {{--<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#changesHistory">Historia zmian i akceptacji</button>--}}
                            {{--</div>--}}
                            {{--<div id="changesHistory" class="collapse" data-parent="#userSettings">--}}
                                {{--<div class="card-body p-0">--}}
                                    {{--<div class="table-responsive">--}}
                                        {{--<table class="history-table table table-striped table-sm mb-0">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th style="min-width: 150px;">Nazwa</th>--}}
                                                {{--<th style="min-width: 300px;">Opis</th>--}}
                                                {{--<th style="min-width: 150px;">Data zmiany</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($historyChanges as $historyChange)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{historyName($historyChange->name)}}</td>--}}
                                                    {{--<td>{{parseHistoryValue($historyChange->name, $historyChange->value)}}</td>--}}
                                                    {{--<td>{{$historyChange->created_at}}</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="card">--}}
                            {{--<div class="card-header">--}}
                                {{--<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#removeAccount">Usuń konto</button>--}}
                            {{--</div>--}}
                            {{--<div id="removeAccount" class="collapse" data-parent="#userSettings">--}}
                                {{--<div class="card-body">--}}
                                    {{--<form method="post" action="{{url('/konto/remove-account')}}">--}}
                                        {{--@csrf--}}
                                        {{--<div class="form-group">--}}
                                            {{--<p class="mb-2">Usunięcie konta wiąże się z usunięciem wszystkich ogłoszeń, wiadomości oraz danych powiązanych z Twoim kontem.--}}
                                                {{--Aby usunąć konto podaj swoje aktualne hasło oraz kliknij w przycisk <b>Usuń konto</b>.</p>--}}
                                            {{--<p>Po wykonaniu akcji usunięcia konta wyślemy do Ciebie ostatnią wiadomość email potwierdzającą usunięcie konta.</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label>Hasło</label>--}}
                                            {{--<input type="password" name="password" placeholder="Wpisz swoje hasło" class="form-control" value="" autocomplete="new-password" required/>--}}
                                        {{--</div>--}}
                                        {{--<div class="text-center">--}}
                                            {{--<button class="btn btn-danger">Usuń konto</button>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection