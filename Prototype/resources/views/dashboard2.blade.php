@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Dashboard</h1>
        <x-adminlte-button data-bs-toggle="modal" data-bs-target="#exampleModal" label="Ajouter un produit" theme="primary" icon="fas fa-plus"/>
    </div>
@stop

@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un Produit</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                @csrf <!-- Laravel CSRF token -->
                <div id="Errors">

                </div>
                <div class="form-group">
                    <label for="nom">Nom du Produit :</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom du produit" required>
                </div>
                <div class="form-group">
                    <label for="prix">Prix :</label>
                    <input type="number" name="prix" id="prix" class="form-control" placeholder="Entrez le prix" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stock :</label>
                    <input type="number" name="stock" id="stock" class="form-control" placeholder="Entrez la quantité en stock" required>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Entrez une description du produit"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <x-adminlte-button class="btn-flat" type="button" id="add_product" label="Ajouter" theme="primary" icon="fas fa-lg fa-save"/>
        </div>
      </div>
    </div>
  </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Liste des Produits</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="productTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="products_rows">
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm delete_product" data-id="{{ $product->id }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        let csrfToken = "{{ csrf_token() }}";
        let produitStoreRoute = "{{ route('produit.store') }}";
        let produitDeleteRoute = "{{ route('produit.destroy', '') }}";
    </script>
    <script src="{{asset('js/productDashboard/addProduct.js')}}"></script>
    <script src="{{asset('js/productDashboard/removeProduct.js')}}">

    </script>
    <script>


    </script>
@stop
