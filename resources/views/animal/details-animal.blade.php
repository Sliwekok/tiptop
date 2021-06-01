@extends('layout')

@push('head-scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endpush

@push('facebook-meta')
    <meta property="og:url" content="{{url('/ogloszenie/szczegoly/' . $animal->id)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{animalSpecies($animal->species)}} {{$animal->name}} - {{animalStatus($animal->status)}}"/>
    <meta property="og:description" content="{{$animal->description}}"/>
    @if($animal->photo)
        <meta property="og:image" content="{{url('upload/animals/' . $animal->photo->file_name)}}"/>
    @else
        <meta property="og:image" content="{{url('images/brak-zdjecia.png')}}"/>
    @endif
    <meta property="fb:app_id" content="882750211905623"/>
@endpush

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ505ckKXe1DEFLkvrDcDJFhGiX1z3ZkM&libraries=places&region=pl&callback=initGoogleMapsOnAnimalDetails" async defer></script>
@endpush

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div id="animal-details" data-id="{{$animal->id}}" data-lat="{{$animal->lat}}" data-lng="{{$animal->lng}}">

                    @if($animal->is_finish)
                        <div class="alert alert-success finish-reason">
                            <h3>Ogłoszenie zakończone</h3>
                            <p>{{animal_status($animal->finish_status)}}.</p>
                            @if($animal->finish_reason)
                                <p><b>Szczegóły:</b> {{$animal->finish_reason}}</p>
                            @endif
                        </div>
                    @endif

                    <div class="photo">
                        @if($animal->photo)
                            <img src="{{url('upload/animals/' . $animal->photo->file_name)}}"/>
                        @else
                            <img src="{{url('images/brak-zdjecia.png')}}"/>
                        @endif
                    </div>

                    <div class="share">
                        <button class="btn btn-facebook facebook-share-btn btn-lg btn-block" data-href="{{url('/ogloszenie/szczegoly/' . $animal->id)}}"><i
                                    class="fab fa-facebook-f mr-2"></i> UDOSTĘPNIJ NA FACEBOOK
                        </button>
                        @if(!$animal->is_finish)
                            @auth
                                <button data-animal-id="{{$animal->id}}" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#createMessage"><i
                                            class="fa fa-envelope mr-2"></i> NAPISZ WIADOMOŚĆ
                                </button>
                            @else
                                <button class="btn btn-warning btn-lg btn-block" data-ref="ogloszenie/szczegoly/{{$animal->id}}" data-toggle="modal" data-target="#loginModal"><i
                                            class="fa fa-envelope mr-2"></i> NAPISZ WIADOMOŚĆ
                                </button>
                            @endauth
                        @endif
                    </div>

                    <div class="f-table">
                        <div class="f-row">
                            <div class="f-col">ID</div>
                            <div class="f-col">{{createReferenceNumber($animal->id)}}</div>
                        </div>
                        <div class="f-row">
                            <div class="f-col">Imię zwierzaka</div>
                            <div class="f-col">{{$animal->name}}</div>
                        </div>
                        <div class="f-row">
                            <div class="f-col">Gatunek</div>
                            <div class="f-col">{{animalSpecies($animal->species)}}</div>
                        </div>
                        <div class="f-row">
                            <div class="f-col">Status</div>
                            <div class="f-col"><span class="status {{strtolower($animal->status)}}">{{animalStatus($animal->status)}}</span></div>
                        </div>
                        <div class="f-row">
                            <div class="f-col">Miejsce @if($animal->status == 'LOST') zaginięcia @else znalezienia @endif</div>
                            <div class="f-col">{{$animal->place_name}}</div>
                        </div>
                        <div class="f-row">
                            <div class="f-col">Godzina @if($animal->status == 'LOST') zaginięcia @else znalezienia @endif</div>
                            <div class="f-col">{{$animal->accident_date}} @ {{substr($animal->accident_time, 0, 5)}}</div>
                        </div>
                        <div class="f-row">
                            <div class="f-col">Opis</div>
                            <div class="f-col">{{$animal->description}}</div>
                        </div>
                        @if($animal->phone && !$animal->is_finish)
                            <div class="f-row">
                                <div class="f-col">Telefon</div>
                                <div class="f-col"><span class="phone-placeholder">Aby wyświetlić numer telefonu potwierdź, że nie jesteś robotem.</span></div>
                            </div>
                        @endif
                    </div>

                    @if($animal->phone && !$animal->is_finish)
                        <div class="captcha">
                            <div class="g-recaptcha" data-callback="onCaptchaResponse" data-sitekey="6Ldwd1YUAAAAAAtnlt4yhrsYmFH2k6pLrS0HcQDN"></div>
                        </div>
                    @endif

                    <div id="map"></div>

                </div>
            </div>
        </div>
    </div>

    @auth
        @include('animal.modals.create-message')
    @endauth

@endsection