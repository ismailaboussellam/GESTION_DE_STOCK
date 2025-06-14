<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 60px;
        }
        .register-container {
            max-width: 480px;
            margin: auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }
        h2 {
            font-weight: 700;
            color: #343a40;
            margin-bottom: 30px;
        }
        label {
            font-weight: 600;
            color: #495057;
        }
        .form-control {
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 15px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #7b2cbf, #9d4edd);
            border: none;
            font-weight: 600;
            border-radius: 10px;
            font-size: 16px;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #6f42c1, #8e44ec);
        }
        .alert {
            font-size: 14px;
        }
        .links {
            text-align: center;
            margin-top: 25px;
        }
        .links a {
            color: #6f42c1;
            font-weight: 500;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .invalid-feedback {
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2 class="text-center">Créer un compte</h2>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nom</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                    />
                    @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                    />
                    @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        required
                    />
                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirmer le mot de passe</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password-confirm"
                        name="password_confirmation"
                        required
                    />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>

                <div class="links">
                    <a href="{{ route('login') }}">Déjà un compte ? Connectez-vous</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>