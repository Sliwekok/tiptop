@extends('emails.mail')

@section('content')
    <tr>
        <td style="width: 100%;" width="100%">
            <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#fff" style="background: #ffffff;">
                <tr>
                    <td align="left">
                        <h4 style="margin: 15px;">Cześć!</h4>
                        <p style="margin: 0 0 5px 15px;">Otrzymaliśmy żądanie zresetowania hasła do Twojego konta.</p>
                        <p style="margin: 0 0 0 15px;">Kliknij w przycisk poniżej, aby ustawić nowe hasło dla swojego konta.</p>
                        @include('emails.partials.button', ['btnTitle' => 'USTAW NOWE HASŁO', 'btnUrl' => url('/nowe-haslo/'.$token)])
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection