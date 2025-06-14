<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eceff1; /* Ice Blue background */
            padding-top: 50px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #263238;
        }

        .profile-container {
            max-width: 720px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
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

        .form-group {
            margin-bottom: 20px;
        }

        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f1f8f9;
            font-weight: bold;
            font-size: 16px;
            color: #26c6da; /* Mint */
            border-bottom: 1px solid #dee2e6;
        }

        .btn-primary {
            background-color: #26c6da;
            border-color: #26c6da;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #00acc1;
            border-color: #00acc1;
        }

        .btn-danger {
            background-color: #ef5350;
            border-color: #ef5350;
            font-weight: 500;
        }

        .btn-outline-secondary {
            font-weight: 500;
            border-radius: 8px;
            color: #455a64;
            border-color: #b0bec5;
        }

        .btn-outline-secondary:hover {
            background-color: #cfd8dc;
            border-color: #b0bec5;
        }

        .alert {
            font-size: 14px;
        }

        small {
            font-size: 13px;
        }

        .invalid-feedback {
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Profil utilisateur</h2>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">← Retour au tableau de bord</a>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row">
                <!-- Profil Info -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Informations du profil</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="email"
                                           value="{{ $user->email }}" disabled>
                                    <small class="form-text text-muted">L'adresse e-mail ne peut pas être modifiée.</small>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Mettre à jour le profil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Changer mot de passe -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Changer le mot de passe</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.change') }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="current_password">Mot de passe actuel</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                           id="current_password" name="current_password" required>
                                    @error('current_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Nouveau mot de passe</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm">Confirmer le nouveau mot de passe</label>
                                    <input type="password" class="form-control" id="password-confirm"
                                           name="password_confirmation" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Déconnexion -->
                <div class="col-md-12 mt-3 text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Se déconnecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>