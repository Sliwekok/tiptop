@extends('layout')

@section('content')
    <div id="user">
        @include('user.partials.header')

        <div class="container">
            <div class="row justify-content-around">
                <div class="col-xl-7 col-lg-8 col-md-12 col-xs-12">
                    <div class="user-animals">
                        @foreach($animals as $animal)
                            <div class="animal">
                                <div class="photo">
                                    @if($animal->photo)
                                        <img src="{{url('upload/animals/' . $animal->photo->file_name)}}"/>
                                    @else
                                        <img src="{{url('images/brak-zdjecia.png')}}" />
                                    @endif
                                </div>
                                <div class="description">
                                    <h3>{{$animal->name}}, <span class="species">{{\App\Helpers\Species::getName($animal->species)}}</span></h3>
                                    <p>Dodano {{$animal->created_at}}</p>
                                    @if($animal->created_at != $animal->updated_at)
                                        <p>Aktualizacja {{$animal->updated_at}}</p>
                                    @endif
                                    @if($animal->is_finish)
                                        <div class="status finish">ZAKOŃCZONO</div>
                                        <span class="status-finish-reason">{{animal_status($animal->finish_status)}}</span>
                                    @else
                                        <div class="status {{strtolower($animal->status)}}">{{strtoupper(\App\Helpers\Status::getName($animal->status))}}</div>
                                    @endif
                                </div>
                                <div class="buttons ml-auto">
                                    <div class="btn-group dropup">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                            Opcje
                                        </button>
                                        <div data-animal-id="{{$animal->id}}" @if ($animal->photo) data-photo-id="{{$animal->photo->id}}" @else data-photo-id="none" @endif class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{url('ogloszenie/szczegoly/' . $animal->id)}}"><i class="fa fa-info" style="margin-right: 17px;margin-left: 4px;"></i>Szczegóły</a>
                                            @if($animal->is_finish == false)
                                                <a class="dropdown-item" href="{{url('ogloszenie/edytuj/' . $animal->id)}}"><i class="fa fa-pencil-alt" style="margin-right: 9px;"></i> Edytuj</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changeAnimalPhoto"><i class="far fa-image" style="margin-right: 9px;"></i> Zmień zdjęcie</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#finishAnimal"><i class="fas fa-times" style="margin-left: 3px;margin-right: 9px;"></i> Zakończ</a>
                                            @endif
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#removeAnimal"><i class="fas fa-trash" style="margin-left: 3px;margin-right: 9px;"></i> Usuń</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('user.modal.change-photo')
    @include('user.modal.finish')
    @include('user.modal.remove')

@endsection