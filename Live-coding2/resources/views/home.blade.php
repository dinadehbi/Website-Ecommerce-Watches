@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Gestion des Produits') }}</div>

                <div class="card-body">
                    <h3 class="mt-4">Liste des Produits</h3>
                    <table class="table table-bordered mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->content ?? 'Aucune description' }}</td>
                                <td>{{ $product->price }} MAD</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('products.create') }}" class="btn btn-primary mt-3">
                        + Ajouter un Produit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
