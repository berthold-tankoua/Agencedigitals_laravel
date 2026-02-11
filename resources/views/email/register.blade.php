<!doctype html>
<html>

<head>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 5px;
            color: #333;
        }

        .container {
            max-width: 600px;
            background: #fff;
            margin: auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #007bff, #007bff);
            padding: 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 28px;
            letter-spacing: 1px;
        }

        .body {
            padding: 25px;
            line-height: 1.6;
        }

        .body h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #007bff;
        }

        .body p {
            margin-bottom: 15px;
            font-size: 15px;
        }

        .body strong {
            color: #222;
        }

        .contact {
            margin-top: 15px;
            padding: 15px;
            background: #fff4f1;
            border-left: 4px solid #007bff;
            border-radius: 6px;
        }

        .contact p {
            margin-bottom: 10px;
            font-size: 14px;
            color: #555;
        }

        .body a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .body a:hover {
            background: #e64a19;
        }

        .footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #eee;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>AgenceDigitals</h1>
        </div>

        <div class="body">
            <h2>🎉 Inscription réussie !</h2>
            <p>Cher <strong>{{ $regisInfo['name'] }}</strong>,</p>
            <p>✅ Votre inscription a été effectuée avec succès.<br>Bienvenue sur la plateforme AgenceDigitals !</p>

            <p>📞 Pour toute question ou assistance, contactez-nous :</p>
            <div class="contact">
                <p>✉️ Email : <strong>AgenceDigitals@gmail.com</strong></p>
                <p>📱 Contact : <strong>+237 696796045 | 681576329</strong></p>
                <p>📍 Adresse : <strong>Cameroun, Douala, Bonamoussadi IPPB</strong></p>
            </div>
        </div>

        <div class="footer">
            &copy; 2025 — Tout droit réservé à AgenceDigitals
        </div>
    </div>

</body>

</html>
