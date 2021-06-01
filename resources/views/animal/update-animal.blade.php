@extends('layout')

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ505ckKXe1DEFLkvrDcDJFhGiX1z3ZkM&libraries=places&region=pl&callback=initGoogleMapsOnUpdateAnimalView" async
            defer></script>
    <script>
        $(document).ready(function () {
            $('input[name="accidentDate"]').mask('0000-00-00');
            $('input[name="accidentTime"]').mask('00:00');
            $('input').attr("autocomplete", "false");
            onAnimalStatusChange();
            onAnimalFormSubmit();
        });
    </script>
@endpush

@section('content')

    <div id="update-animal">

        <div class="welcome">
            <h3>Edytuj ogłoszenie</h3>
            <p>Wprowadź zmiany w ogłoszeniu i zapisz zmiany.</p>
        </div>

        <form name="animalForm" method="post" autocomplete="off" role="presentation" action="{{url('ogloszenie/edytuj')}}">

            {{csrf_field()}}

            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-xl-8">

                        <div class="form-wrapper">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>Gatunek*</label>
                                        <select class="form-control" name="species" required>
                                            <option @if($animal->species == 'CAT') selected @endif value="CAT">Kot</option>
                                            <option @if($animal->species == 'DOG') selected @endif value="DOG">Pies</option>
                                            <option @if($animal->species == 'HAMSTER') selected @endif value="HAMSTER">Chomik</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label>Status*</label>
                                    <select class="form-control" name="status" required>
                                        <option @if($animal->species == 'LOST') selected @endif value="LOST">ZAGINIONY</option>
                                        <option @if($animal->species == 'FOUND') selected @endif value="FOUND">ZNALEZIONY</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label>Imię zwierzęcia*</label>
                                    <input type="text" value="{{$animal->name}}" name="name" maxlength="64" required class="form-control"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Lokalizacja*</label>

                                        <div class="input-group">
                                            <input id="place" value="{{$animal->place_name}}" placeholder="Wyszukaj i wybierz z listy" type="text" disabled="disabled" name="localization"
                                                   maxlength="512" required class="form-control"/>
                                            <div class="input-group-append">
                                                <button id="place-clear" class="btn btn-danger" type="button"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>

                                        <input type="hidden" id="lat" name="lat" value="{{$animal->lat}}"/>
                                        <input type="hidden" id="lng" name="lng" value="{{$animal->lng}}"/>
                                        <input type="hidden" id="placeName" name="placeName" value="{{$animal->place_name}}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div id="map" style="width: 100%;height: 175px;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>Data zaginięcia*</label>
                                        <input type="date" placeholder="RRRR-MM-DD" value="{{$animal->accident_date}}" name="accidentDate" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>Godzina zaginięcia*</label>
                                        <input type="time" placeholder="GG:MM" value="{{$animal->accident_time}}" name="accidentTime" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>Telefon</label>
                                        <input type="text" value="{{$animal->phone}}" maxlength="16" name="phone" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Opis*</label>
                                        <textarea class="form-control" name="description" required maxlength="2048" placeholder="Napisz kilka słów o swoim zwierzęciu" rows="6">{{$animal->description}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input @if($animal->notification) checked @endif type="checkbox" class="custom-control-input" name="notification" id="notification">
                                        <label style="line-height: 1.7;" class="custom-control-label" for="notification">Chcę otrzymywać powiadomienia dotyczące tego ogłoszenia.</label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="idAnimal" value="{{$animal->id}}"/>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-warning btn-lg submit-btn">Zapisz zmiany</button>
                                <small class="d-block mt-3">Pola oznaczone * są wymagane.<br/>Podanie numeru telefonu jest dobrowolne.</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection