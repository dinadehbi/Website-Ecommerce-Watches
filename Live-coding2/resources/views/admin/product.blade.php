<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1 class="text-center mb-4">Gestion des Produits</h1>

    <!-- Button to Open Modal -->
    <button class="btn btn-primary mb-3" id="showCreateForm" data-bs-toggle="modal" data-bs-target="#productModal">
        + Créer un Nouveau Produit
    </button>

    <!-- Products Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productsTableBody">
            @foreach($products as $product)
            <tr id="productRow{{ $product->id }}">
                <td>{{ $product->title }}</td>
                <td>{{ $product->content ?? 'Aucune description' }}</td>
                <td>{{ $product->price }} MAD</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <button class="btn btn-danger btn-sm deleteProduct" data-id="{{ $product->id }}">🗑️</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bootstrap Modal for Product Creation -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Créer un Produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" id="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="content" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prix</label>
                            <input type="number" id="price" class="form-control" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantité</label>
                            <input type="number" id="stock" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        // Submit Product Form
        $('#productForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('products.store') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    title: $('#title').val(),
                    content: $('#content').val(),
                    price: $('#price').val(),
                    stock: $('#stock').val(),
                },
                success: function(response) {
                    let product = response.product;
                    let newRow = `
                        <tr id="productRow${product.id}">
                            <td>${product.title}</td>
                            <td>${product.content}</td>
                            <td>${product.price} MAD</td>
                            <td>${product.stock}</td>
                            <td>
                                <button class="btn btn-danger btn-sm deleteProduct" data-id="${product.id}">🗑️</button>
                            </td>
                        </tr>
                    `;
                    $('#productsTableBody').append(newRow);
                    alert("Produit créé avec succès !");
                    $('#productModal').modal('hide'); // Hide modal
                    $('#productForm')[0].reset();
                },
                error: function(xhr) {
                    alert('Erreur: ' + xhr.responseJSON.message);
                }
            });
        });

        // Delete Product
        $(document).on('click', '.deleteProduct', function() {
            if (!confirm('Confirmer la suppression ?')) return;

            let id = $(this).data('id');

            $.ajax({
                url: `/products/${id}`,
                type: 'DELETE',
                data: { _token: "{{ csrf_token() }}" },
                success: function() {
                    $(`#productRow${id}`).remove();
                    alert("Produit supprimé avec succès !");
                },
                error: function(xhr) {
                    alert('Erreur: ' + xhr.responseJSON.message);
                }
            });
        });
    });
    </script>

</body>
</html>
