<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nouveau message - AgenceDigitals</title>
</head>

<body style="margin:0; padding:0; background:#f4f6f9; font-family: Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9; padding:20px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border:1px solid #e5e5e5;">

                    <!-- Header -->
                    <tr>
                        <td style="padding:20px; text-align:center; background:#0d6efd; color:#ffffff;">
                            <h1 style="margin:0; font-size:22px;">AgenceDigitals</h1>
                            <p style="margin:5px 0 0; font-size:13px;">
                                Nouveau message reçu
                            </p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:25px; color:#333333; font-size:14px; line-height:1.6;">

                            <p style="margin-top:0;">Bonjour,</p>

                            <p>
                                Vous avez reçu un nouveau message via votre site web.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:15px;">
                                <tr>
                                    <td style="padding:8px 0;">
                                        <strong>Email :</strong> {{ $clientmsg['email'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;">
                                        <strong>Téléphone :</strong> {{ $clientmsg['contact'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;">
                                        <strong>Objet :</strong> {{ $clientmsg['objet'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;">
                                        <strong>Message :</strong><br>
                                        {{ $clientmsg['message'] }}
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:15px; text-align:center; background:#f8f9fa; font-size:12px; color:#777;">
                            © {{ date('Y') }} AgenceDigitals — Tous droits réservés
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
