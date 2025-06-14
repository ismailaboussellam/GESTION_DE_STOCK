<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eceff1; /* Ice Blue background */
            padding-top: 50px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #263238; /* Dark gray text */
        }

        .forgot-container {
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
            background-color: #26c6da; /* Minty cyan */
            border-color: #26c6da;
            font-weight: 500;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #00acc1;
            border-color: #00acc1;
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
        <div class="forgot-container">
            <h2 class="text-center mb-4">Mot de passe oublié</h2>
            
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <p class="mb-4 text-muted">Veuillez saisir votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe.</p>
            
            <form method="POST" action="{{ route('password.email') }}">
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
                    <button type="submit" class="btn btn-primary">Envoyer le lien de réinitialisation</button>
                </div>
                
                <div class="links">
                    <a href="{{ route('login') }}">← Retour à la connexion</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>