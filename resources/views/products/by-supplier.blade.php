{{-- resources/views/products/by-supplier.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Produits par Fournisseur</h2>

    <form method="GET" action="{{ route('products.by.supplier') }}">
        <div class="mb-3">
            <label for="supplier">Choisir un fournisseur:</label>
            <select name="supplier_id" id="supplier" class="form-select" onchange="this.form.submit()">
                <option value="">-- Sélectionner --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->first_name . ' ' .  $supplier->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @isset($products)
        @if($products->isEmpty())
            <p>Aucun produit trouvé pour ce fournisseur.</p>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p><strong>Catégorie:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                                <p><strong>Stock:</strong> {{ $product->stock->quantity ?? 'N/A' }}</p>
                                <p><strong>Prix:</strong> {{ $product->price }} DH</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endisset
</div>
@endsection
