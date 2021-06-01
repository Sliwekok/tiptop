@extends('emails.mail')

@section('content')
    <tr>
        <td style="width: 100%;" width="100%">
            <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#fff" style="background: #ffffff;">
                <tr>
                    <td align="left">
                        <h4 style="margin: 15px;">Witaj{{' ' . $userName or ''}} :)</h4>
                        <p style="margin: 0 0 0 15px;">Dziękujemy za dołączenie do społeczności Sarz.pl</p>
                        @include('emails.partials.button', ['btnTitle' => 'ZALOGUJ SIĘ', 'btnUrl' => url('/')])
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection