@extends('layout')

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ505ckKXe1DEFLkvrDcDJFhGiX1z3ZkM&libraries=places&region=pl&callback=initGoogleMapsOnCreateAnimalView" async
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

    <div id="add-animal">

        <div class="welcome">
            <h3>Dodaj ogłoszenie</h3>
            <p>Uzupełnij formularz, aby dodać ogłoszenie.</p>
        </div>

        <form name="animalForm" method="post" autocomplete="off" role="presentation" enctype="multipart/form-data" action="{{url('ogloszenie/dodaj')}}">

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
                                            <option value="">Wybierz</option>
                                            <option value="CAT">Kot</option>
                                            <option value="DOG">Pies</option>
                                            <option value="HAMSTER">Chomik</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>Status*</label>
                                        <select class="form-control" name="status" required>
                                            <option value="">Wybierz</option>
                                            <option value="LOST">ZAGINIONY</option>
                                            <option value="FOUND">ZNALEZIONY</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>Imię zwierzęcia*</label>
                                        <input type="text" name="name" autocomplete="off" maxlength="64" required class="form-control"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Zdjęcie*</label>
                                        <input type="file" required name="photo" accept="image/jpeg,image/png,image/gif" class="form-control-file" id="uploadFile"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">

                                        <label>Lokalizacja*</label>

                                        <div class="input-group">
                                            <input autocomplete="off" id="place" placeholder="Wyszukaj i wybierz z listy" type="text" name="localization" maxlength="512" required
                                                   class="form-control"/>
                                            <div class="input-group-append">
                                                <button id="place-clear" class="btn btn-danger" disabled="disabled" type="button"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>

                                        <input type="hidden" id="lat" name="lat" value=""/>
                                        <input type="hidden" id="lng" name="lng" value=""/>
                                        <input type="hidden" id="placeName" name="placeName" value=""/>

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
                                        <input type="date" placeholder="RRRR-MM-DD" name="accidentDate" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>Godzina zaginięcia*</label>
                                        <input type="time" placeholder="GG:MM" name="accidentTime" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label>Telefon</label>
                                        <input type="text" maxlength="16" name="phone" class="form-control"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Opis*</label>
                                        <textarea class="form-control" name="description" required maxlength="2048" placeholder="Napisz kilka słów o swoim zwierzęciu" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input checked type="checkbox" class="custom-control-input" name="notification" id="notification">
                                        <label style="line-height: 1.7;" class="custom-control-label" for="notification">Chcę otrzymywać powiadomienia dotyczące tego ogłoszenia.</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-warning btn-lg submit-btn">Dodaj ogłoszenie</button>
                                <small class="d-block mt-3">Pola oznaczone * są wymagane.<br/>Podanie numeru telefonu jest dobrowolne.</small>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection