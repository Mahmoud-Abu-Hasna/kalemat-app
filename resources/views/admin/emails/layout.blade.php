<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700" rel="stylesheet">
</head>
<body style="margin: 0; padding-top: 30px; background-color: #f5f8fb; direction: rtl;">
<table  align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse">
    <tr>
        <td>
            <table width="100%" align="center" style="border-collapse: collapse; background-color: #fff;font-family: 'Cairo', sans-serif; ">
                <tr>
                    <td style=" padding: 25px 25px 0 25px; vertical-align: middle;">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td align="right" style="vertical-align: top;font-size: 24px;color:red;">
                                    <a href="{{ route('user.home') }}" style="text-decoration: none;    display: table;margin: auto;">
                                        {{ config('app.name', 'Laravel') }}
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 25px;">
                        <table cellpadding="0" cellspacing="0" width="100%">

                            @yield('content')

                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="text-align:center;">
            <p style="color: #2e2e2e; font-size: 13px;">{{ config('app.name', 'Laravel') }}</p>
            <p style="color: #2e2e2e; font-size: 13px;">You can cancel subscription from <a href="{{ route('home.unsubscribe', ['token'=>$subscription->token]) }}" target="_blank" style="text-decoration: none;color: #0000F0;">Here</a> </p>
        </td>
    </tr>
</table>

</body>
</html>
