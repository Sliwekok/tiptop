<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ $mailTitle or '' }}</title>
    <style type="text/css">
        a {
            color: #e6603f;
            text-decoration: none;
        }
    </style>
</head>
<body bgcolor="#f5f5f5" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0"
      style="padding: 30px 0;-webkit-font-smoothing: antialiased;width:100% !important;background:#f5f5f5;-webkit-text-size-adjust:none;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 14px;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f5f5f5">

    <!-- Header with logo -->
    <tr>
        <td style="width: 100%;" width="100%">
            <table width="580" cellpadding="30" cellspacing="0" border="0" align="center" bgcolor="#fff" style="background: #ffffff;">
                <tr>
                    <td align="center"><img src="{{url('images/logo.jpg')}}" alt="sarz.pl" style="width: 179px;"/></td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Gray spacer -->
    <tr>
        <td style="width: 100%;" width="100%">
            <table width="580" cellpadding="1" cellspacing="0" border="0" align="center" bgcolor="#fff" style="background: #ccc;">
                <tr>
                    <td align="center"></td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Content -->
    @yield('content')

    <!-- Gray spacer -->
    <tr>
        <td style="width: 100%;" width="100%">
            <table width="580" cellpadding="1" cellspacing="0" border="0" align="center" bgcolor="#fff" style="background: #ccc;">
                <tr>
                    <td align="center"></td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="width: 100%;" width="100%">
            <table width="580" cellpadding="10" cellspacing="0" border="0" align="center" bgcolor="#fff" style="background: #ffffff;">
                <tr>
                    <td align="center" style="font-size: 10px;color: #666666;">
                        <p>Otrzymujesz tę wiadomość, ponieważ jesteś zarejestrowany/a w serwisie <a href="{{url('/')}}">sarz.pl</a>.</p>
                        <a href="{{url('/konto/ustawienia')}}">Zmień ustawienia powiadomień e-mail.</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

</table>

</body>
</html>