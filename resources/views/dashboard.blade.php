@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="text-center bg-light p-4 rounded shadow-sm">
        <h2 class="display-4 mb-4 text-primary">Bienvenue au Système de Gestion des Stocks</h2>
        <p class="lead mb-4 text-muted">Gérez efficacement votre inventaire et vos clients</p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="/customers" class="btn btn-primary btn-lg m-2 shadow">Liste des Clients</a>
            <a href="/suppliers" class="btn btn-success btn-lg m-2 shadow">Liste des Fournisseurs</a>
            <a href="/products" class="btn btn-info btn-lg m-2 shadow">Liste des Produits</a>
            <a href="/products-by-category" class="btn btn-warning btn-lg m-2 shadow">Produits par Catégorie</a>
            <a href="/products-by-supplier" class="btn btn-secondary btn-lg m-2 shadow">Produits par Fournisseur</a>
            <a href="/products-by-store" class="btn btn-dark btn-lg m-2 shadow">Produits par Magasin</a>
            
        </div>
    </div>

    <div>
    
    
    
   
    
        <div class="container" style="margin-top: 7%"> 
           
            <div class="row justify-content-center"> 
    
                <div class="col-md-8"> 
                    <div class="d-flex flex-column gap-4">

                        <div class="card shadow-lg">
                            <div class="card-body">
                                <h2 class="card-title h4 mb-4 text-primary"><i class="fas fa-cookie-bite me-2"></i> Gérer un Cookie</h2>
                                                <h4>
                                                    Hello Cookie:
                                                    @if(Cookie::has("UserName"))
                                                     <span class="highlight-cookie">{{ Cookie::get("UserName") }}</span>
                                                    @else
                                                       <span class="text-muted">(Aucun cookie)</span>
                                                     @endif
                                                </h4>

                                <form method="POST" action="saveCookie">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="txtCookie" class="form-label">Entrez votre nom :</label>
                                        <input
                                            type="text"
                                            name="txtCookie"
                                            id="txtCookie"
                                            placeholder="Votre nom ici..."
                                            class="form-control form-control-sm"
                                        >
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-save me-2"></i> Enregistrer le Cookie
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card shadow-lg">
                            <div class="card-body">
                                <h2 class="card-title h4 mb-4 text-success"><i class="fas fa-box me-2"></i> Gérer une Session</h2>
                                <div class="mb-3">
                                    <h1 class="h5">
                                        Hello Session:
                                        @if(Session::has("SessionName"))
                                         <span class="highlight-session">{{ Session("SessionName") }}</span>
                                        @else
                                           <span class="text-muted">(Aucune session active)</span>
                                         @endif
                                    </h1>

                                </div>
                                <form method="POST" action="saveSession">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="txtSession" class="form-label">Entrez votre nom pour la session :</label>
                                        <input
                                            type="text"
                                            name="txtSession"
                                            id="txtSession"
                                            placeholder="Nom de session..."
                                            class="form-control form-control-sm"
                                        >
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-box me-2"></i> Enregistrer la Session
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card shadow-lg">
                            <div class="card-body">
                                <h2 class="card-title h4 mb-4 text-info"><i class="fas fa-image me-2"></i> Gérer l'Avatar</h2>
                                <form method="POST" action="saveAvatar" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="avatarFile" class="form-label">Choisissez votre image de profil :</label>
                                        <input
                                            type="file"
                                            name="avatarFile"
                                            id="avatarFile"
                                            class="form-control form-control-sm"
                                        />
                                    </div>
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <i class="fas fa-upload me-2"></i> Enregistrer l'image
                                    </button>
                                   
                                    @if(isset($pic))
                                        <div class="mt-4 text-center">
                                            <p class="text-muted mb-2">Image actuelle :</p>
                                            <img class="img-fluid rounded-circle border border-secondary shadow-sm"
                                             style="width: 120px; height: 120px; object-fit: cover;"
                                              src="{{"storage/avatars/.$pic"}}" alt="Avatar">
                                        </div>
                                    @endif 
                                </form>
                            </div>
                        </div>

                    </div> 
                </div> 
            </div> 
        </div> 
</div>
@endsection     
