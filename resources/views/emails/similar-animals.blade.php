@extends('emails.mail')

@section('content')
    <tr>
        <td style="width: 100%;" width="100%">
            <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#fff" style="background: #ffffff;">
                <tr>
                    <td align="left">

                        <h3 style="text-align: center;font-size: 18px;">{{$status}} {{$species}} {{$animalName}}</h3>

                        <p style="margin: 0 0 0 15px;text-align: center;line-height: 1.4;">
                            Mamy dobrą wiadomość! W Serwisie <a href="{{url('/')}}">sarz.pl</a> pojawiły się nowe ogłoszenia pasujące do Twojego ogłoszenia. Nie zwlekaj i sprawdź je teraz.
                        </p>

                        @foreach($animals as $animal)
                            <div style="border: 1px solid #ccc;width: 300px;margin: 15px auto 30px auto;padding-bottom: 10px;">
                                @if($animal->status === 'FOUND')
                                    <div style="color: #ffffff;width: 100%;font-size: 13px;text-align: center;background-color: #DBA511;height: 30px;line-height: 2.3;letter-spacing: 1px;font-weight: bold;">
                                        ZNALEZIONY {{strtoupper($species)}}
                                    </div>
                                @else
                                    <div style="color: #ffffff;width: 100%;font-size: 13px;text-align: center;background-color: #DB1111;height: 30px;line-height: 2.3;letter-spacing: 1px;font-weight: bold;">
                                        ZAGINIONY {{strtoupper($species)}}
                                    </div>
                                @endif
                                @if($animal->photo)
                                    <img style="width: 300px;border-bottom: 1px solid #ccc;" src="{{url('upload/animals/' . $animal->photo->file_name)}}"/>
                                @else
                                    <img style="width: 300px;border-bottom: 1px solid #ccc;" src="{{url('images/brak-zdjecia.png')}}"/>
                                @endif
                                <div style="padding: 10px 10px 0 10px;text-align: center;">
                                    {{$accidentDate}} @ {{$accidentTime}} w {{$placeName}}
                                </div>
                                <div style="padding: 10px;text-align: justify;">{{str_limit($animal->description, 105)}}</div>
                                @include('emails.partials.button-small', ['btnTitle' => 'ZOBACZ OGŁOSZENIE', 'btnUrl' => url('/ogloszenie/szczegoly/' . $animal->id)])
                            </div>
                        @endforeach

                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection