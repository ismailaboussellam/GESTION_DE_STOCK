<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vérification de l'adresse e-mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 60px;
        }
        .verify-container {
            max-width: 480px;
            margin: auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
            text-align: center;
        }
        h2 {
            font-weight: 700;
            color: #343a40;
            margin-bottom: 30px;
        }
        p {
            font-size: 15px;
            color: #495057;
            margin-bottom: 25px;
        }
        .alert {
            font-size: 14px;
            border-radius: 10px;
        }
        .links a {
            color: #6f42c1;
            font-weight: 600;
            text-decoration: none;
            font-size: 15px;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="verify-container">
            <h2>Vérification de l'adresse e-mail</h2>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="alert alert-info">
                Un lien de vérification a été envoyé à votre adresse e-mail. Veuillez vérifier votre boîte de réception et cliquer sur le lien pour activer votre compte.
            </div>

            <p>Si vous n'avez pas reçu l'e-mail, vous pouvez demander un nouveau lien de vérification.</p>

            <div class="links">
                <a href="{{ route('login') }}">Retour à la connexion</a>
            </div>
        </div>
    </div>
</body>
</html>