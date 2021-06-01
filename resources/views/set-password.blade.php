@extends('layout')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-7 col-lg-6 col-xl-5">
                <div class="card mt-5">
                    <div class="card-header">
                        Ustaw nowe hasło
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{url('nowe-haslo')}}">
                            @csrf
                            <div class="form-group">
                                <label>Nowe hasło</label>
                                <input type="password" name="password" class="form-control" required placeholder="Wpisz nowe hasło" autofocus autocomplete="new-password"/>
                            </div>
                            <div class="form-group">
                                <label>Powtórz hasło</label>
                                <input type="password" name="repeatPassword" class="form-control" required placeholder="Powtórz nowe hasło" autofocus autocomplete="new-password"/>
                            </div>
                            <input type="hidden" name="passwordToken" value="{{$token}}" />
                            <div class="text-center">
                                <button class="btn btn-warning" type="submit">Zatwierdź</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection