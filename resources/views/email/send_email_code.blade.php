<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Email - AgenceDigitals</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #007BFF;
            margin-bottom: 20px;
        }

        .message {
            font-size: 18px;
            color: #333333;
            margin-bottom: 30px;
        }

        .code {
            font-size: 32px;
            font-weight: bold;
            color: #007BFF;
            letter-spacing: 2px;
            background: #e6f0ff;
            padding: 15px 25px;
            display: inline-block;
            border-radius: 8px;
        }

        @media (max-width: 480px) {
            .email-container {
                padding: 20px 10px;
            }

            .code {
                font-size: 28px;
                padding: 12px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="logo">AgenceDigitals</div>
        <div class="message">
            Veuillez utiliser le code ci-dessous pour valider votre adresse mail
        </div>
        <div class="code">{{ $emailInfo['code'] }}</div>
    </div>
</body>

</html>
