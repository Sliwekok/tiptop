@extends('layout')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-7 col-lg-6 col-xl-5">
                <div class="card mt-5">
                    <div class="card-header">
                        Rejestracja konta przez Facebook
                    </div>
                    <div class="card-body">
                        <p class="font-weight-bold mb-2">Hej {{$user->name}}!</p>
                        <p class="mb-2">Od założenia konta dzieli Cię już tylko jeden krok. Zapoznaj się z naszym rgulaminem oraz polityką prywatności.
                            Jeżeli wszystko jest OK to zaakceptuj zgody i zatwierdź rejestrację konta. Możesz również zmienić swoją nazwę użytkownika.</p>

                        <form name="facebookRegister" method="post" action="{{url('facebook-register')}}">
                            @csrf
                            <div class="form-group">
                                <label>Nazwa użytkownika</label>
                                <input type="text" autofocus class="form-control" name="name" value="{{$user->name}}" required/>
                            </div>
                            <div class="form-group">
                                <label>Adres e-mail</label>
                                <input type="email" class="form-control" readonly name="email" value="{{$user->email}}"/>
                            </div>

                            <div class="form-group text-left approval">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" required class="custom-control-input" name="terms" id="term">
                                    <label class="custom-control-label" for="term">Akceptuję <a title="Kliknij, aby wyświetlić regulamin" href="{{url('/regulamin')}}" target="_blank">regulamin</a> oraz <a title="Kliknij, aby wyświetlić politykę prywatności" href="{{url('/polityka-prywatnosci')}}" target="_blank">politykę prywatności</a> sarz.pl.*</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" required class="custom-control-input" name="personalData" id="personalData">
                                    <label class="custom-control-label" for="personalData">Akceptuję <a href="{{url('/dane-osobowe')}}" target="_blank">zasady przetwarzania moich danych osobowych</a> przez Serwis sarz.pl.*</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="messagesNotification" id="messagesNotification">
                                    <label class="custom-control-label" for="messagesNotification">Wyrażam zgodę na otrzymywanie powiadomień e-mail.</label>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="{{$user->id}}"/>
                            <input type="hidden" name="provider" value="{{$provider}}"/>
                            <input type="hidden" name="secure" value="{{$secure}}"/>

                            <div class="text-center">
                                <button type="submit" class="btn btn-warning">Zatwierdź i zarejestruj</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection