@extends('layout')

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ505ckKXe1DEFLkvrDcDJFhGiX1z3ZkM&libraries=places&region=pl&callback=initPlacesApi" async defer></script>
    <script>
        $(document).ready(attachSearchBox);
    </script>
@endpush

@section('content')

    <div id="lost-found">

        <div class="search-box-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <form id="searchForm" action="{{url('zaginione-znalezione')}}">
                            <div class="search-box">
                                <div class="filter-status">
                                    <select name="status" class="form-control">
                                        <option @if($request['status'] == 'ALL') selected @endif value="ALL">Wszystkie</option>
                                        <option @if($request['status'] == 'LOST') selected @endif value="LOST">Zaginione</option>
                                        <option @if($request['status'] == 'FOUND') selected @endif value="FOUND">Znalezione</option>
                                    </select>
                                </div>
                                <div class="filter-species">
                                    <select name="species" class="form-control">
                                        <option @if($request['species'] == 'ALL') selected @endif value="ALL">Wszystkie</option>
                                        <option @if($request['species'] == 'CAT') selected @endif value="CAT">Kot</option>
                                        <option @if($request['species'] == 'DOG') selected @endif value="DOG">Pies</option>
                                        <option @if($request['species'] == 'HAMSTER') selected @endif value="HAMSTER">Chomik</option>
                                    </select>
                                </div>
                                <div class="filter-localization">
                                    <div class="input-group">
                                        <input id="place" value="{{$request['place']}}" placeholder="Wyszukaj i wybierz z listy" type="text" name="localization" maxlength="512"
                                               class="form-control"/>
                                        <div class="input-group-append">
                                            <button id="place-clear" class="btn btn-danger no-marker" @if($request['place'] == '') disabled="disabled" @endif type="button"><i
                                                        class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="lat" name="lat" value="{{$request['lat']}}"/>
                                    <input type="hidden" id="lng" name="lng" value="{{$request['lng']}}"/>
                                    <input type="hidden" id="placeName" name="placeName" value="{{$request['place']}}"/>
                                </div>
                                <div class="filter-range">
                                    <select name="distance" class="form-control">
                                        <option @if($request['distance'] == '5') selected @endif value="5">5 km</option>
                                        <option @if($request['distance'] == '10') selected @endif value="10">10 km</option>
                                        <option @if($request['distance'] == '15') selected @endif value="15">15 km</option>
                                        <option @if($request['distance'] == '20') selected @endif value="20">20 km</option>
                                        <option @if($request['distance'] == '25') selected @endif value="25">25 km</option>
                                        <option @if($request['distance'] == '30') selected @endif value="30">30 km</option>
                                        <option @if($request['distance'] == '40') selected @endif value="40">40 km</option>
                                        <option @if($request['distance'] == '50') selected @endif value="50">50 km</option>
                                        <option @if($request['distance'] == '60') selected @endif value="60">60 km</option>
                                        <option @if($request['distance'] == '75') selected @endif value="75">75 km</option>
                                        <option @if($request['distance'] == '85') selected @endif value="85">85 km</option>
                                        <option @if($request['distance'] == '100') selected @endif value="100">100 km</option>
                                    </select>
                                </div>
                                <div class="filter-words">
                                    <input type="text" value="{{$request['words']}}" maxlength="64" name="words" placeholder="Słowa kluczowe np. biała łapa" class="form-control"/>
                                </div>
                                <div class="submit-btn">
                                    <button class="btn btn-warning" type="submit">S</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="welcome">
                        @if($request['status'] == 'FOUND')
                            <h3>Znalezione Zwierzęta</h3>
                        @elseif($request['status'] == 'LOST')
                            <h3>Zaginione Zwierzęta</h3>
                        @elseif($request['status'] == 'ALL')
                            <h3>Zaginione i znalezione Zwierzęta</h3>
                        @endif
                        <p>Znaleziono {{$animals->total()}} ogłoszeń</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach($animals as $animal)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="animal">
                            <div class="status-heading {{strtolower($animal->status)}}">
                                {{str_limit(animalStatus($animal->status) . " " . animalSpecies($animal->species) . " " . $animal->name, 33 , '...')}}
                            </div>
                            <div class="photo">
                                @if($animal->photo)
                                    <img src="{{url('upload/animals/' . $animal->photo->file_name)}}"/>
                                @else
                                    <img src="{{url('images/brak-zdjecia.png')}}"/>
                                @endif
                            </div>
                            <div class="heading">
                                <div class="name">
                                    <h1>{{$animal->name}}, <span>{{animalSpecies($animal->species)}}</span></h1>
                                </div>
                            </div>
                            <div class="localization">
                                <p><i class="fas fa-map-marker-alt mr-1"></i> {{$animal->accident_date}} @ {{substr($animal->accident_time, 0, 5)}} w {{$animal->place_name}}</p>
                            </div>
                            <div class="description">
                                <p>{{str_limit($animal->description, 200 , '...')}}</p>
                            </div>
                            <div class="buttons2">
                                <a href="{{url('ogloszenie/szczegoly/' . $animal->id)}}">Szczegóły</a>
                                <a href="#" class="facebook-share-btn" data-href="{{url('/ogloszenie/szczegoly/' . $animal->id)}}"><i class="fab fa-facebook-f mr-1"></i> Udostępnij</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{--<div class="container">--}}
        {{--<div class="row">--}}
        {{--<div class="col">--}}

        {{--@foreach($animals as $animal)--}}
        {{--<div class="animal">--}}
        {{--<div class="status-heading {{strtolower($animal->status)}}">--}}
        {{--{{animalStatus($animal->status)}} {{animalSpecies($animal->species)}} {{$animal->name}}--}}
        {{--</div>--}}
        {{--<div class="photo">--}}
        {{--@if($animal->photo)--}}
        {{--<img src="{{url('upload/animals/' . $animal->photo->file_name)}}"/>--}}
        {{--@else--}}
        {{--<img src="{{url('images/brak-zdjecia.png')}}"/>--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--<div class="heading">--}}
        {{--<div class="name">--}}
        {{--<h1>{{$animal->name}}, <span>{{animalSpecies($animal->species)}}</span></h1>--}}
        {{--</div>--}}
        {{--<div class="update-date" data-toggle="tooltip" data-placement="top" title="Data ostatniej aktualizacji">--}}
        {{--<i class="far fa-clock mr-1"></i> {{$animal->updated_at}}--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="localization">--}}
        {{--<p><i class="fas fa-map-marker-alt mr-1"></i> {{$animal->accident_date}} @ {{substr($animal->accident_time, 0, 5)}} w {{$animal->place_name}}</p>--}}
        {{--</div>--}}
        {{--<div class="description">--}}
        {{--<p>{{$animal->description}}</p>--}}
        {{--</div>--}}
        {{--<div class="buttons">--}}
        {{--<a href="{{url('ogloszenie/szczegoly/' . $animal->id)}}" class="btn btn-warning">Szczegóły</a>--}}
        {{--<button class="btn facebook-share-btn btn-facebook" data-href="{{url('/ogloszenie/szczegoly/' . $animal->id)}}"><i class="fab fa-facebook-f mr-1"></i> Udostępnij</button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--@endforeach--}}

        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{ $animals->links() }}

    </div>

@endsection