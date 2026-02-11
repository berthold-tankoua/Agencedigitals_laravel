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
            background: linear-gradient(135deg, #28a745, #20c997);
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
            margin-bottom: 10px;
            color: #28a745;
        }

        .body p {
            margin-bottom: 12px;
            font-size: 15px;
        }

        .body strong {
            color: #222;
        }

        .contact {
            margin-top: 15px;
            padding: 15px;
            background: #f9fbfd;
            border-left: 4px solid #28a745;
            border-radius: 6px;
        }

        .contact p {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .body a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 18px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .body a:hover {
            background: #1e7e34;
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
            <h2>✅ Paiement réussi</h2>
            <p>Bonjour <strong>{{ $OrderInfo['name'] }}</strong>,</p>
            <p>Nous vous confirmons que votre paiement a été effectué avec succès.</p>
            <p>Voici les détails de votre transaction :</p>

            <div class="contact">
                <p>📄 Référence commande : <strong>{{ $OrderInfo['invoice_no'] }}</strong></p>
                <p>💳 Méthode de paiement : <strong>{{ $OrderInfo['payment_type'] }}</strong></p>
                <p>💰 Montant : <strong>{{ $OrderInfo['amount'] }}</strong></p>
            </div>

            <a href="{{ url('/user/dashboard') }}">Voir ma commande</a>
        </div>

        <div class="footer">
            &copy; 2025 — Tout droit réservé à AgenceDigitals
        </div>
    </div>

</body>

</html>
