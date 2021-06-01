@extends('layout')

@section('content')

    <div id="error">
        <div class="row">
            <div class="col">
                <div class="error-wrapper">
                    <h1>Wystąpił błąd!</h1>
                    <h3>{{$exception}}</h3>
                    <a href="{{url('/')}}" class="btn btn-warning btn-lg">Strona główna</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection