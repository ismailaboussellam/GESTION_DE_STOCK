<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eceff1; /* Ice Blue background */
            padding-top: 50px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #263238;
        }

        .login-container {
            max-width: 450px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #26c6da; /* Mint */
            border-color: #26c6da;
            font-weight: 500;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #00acc1;
            border-color: #00acc1;
        }

        .form-check-label {
            font-weight: 500;
            color: #455a64;
        }

        .alert {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .links {
            margin-top: 20px;
            text-align: center;
        }

        .links a {
            color: #26c6da;
            font-weight: 500;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        h2 {
            color: #263238;
            font-weight: 600;
        }

        label {
            font-weight: 500;
            color: #455a64;
        }

        .form-control {
            padding: 10px;
            font-size: 15px;
            border-radius: 0.375rem;
            border: 1px solid #b0bec5;
        }

        .form-control:focus {
            border-color: #26c6da;
            box-shadow: 0 0 0 0.2rem rgba(38, 198, 218, 0.25);
        }

        .invalid-feedback {
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2 class="text-center mb-4">Connexion</h2>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password" required>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Garder la session ouverte</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>

                <div class="links">
                    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a><br>
                    <a href="{{ route('register') }}">Créer un compte</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>