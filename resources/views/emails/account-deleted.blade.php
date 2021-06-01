@extends('emails.mail')

@section('content')
    <tr>
        <td style="width: 100%;" width="100%">
            <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#fff" style="background: #ffffff;">
                <tr>
                    <td align="left">
                        <h4 style="margin: 15px;">Witaj!</h4>
                        <p style="margin: 0 0 0 15px;">Twoje konto w serwisie <a href="{{url('/')}}">Sarz.pl</a> zostało usunięte.</p>
                        @include('emails.partials.button', ['btnTitle' => 'DOŁĄCZ DO NAS', 'btnUrl' => url('/konto')])
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection