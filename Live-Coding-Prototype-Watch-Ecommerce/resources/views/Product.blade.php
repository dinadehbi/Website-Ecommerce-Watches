<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
</head>
<body>
    <h1>Gestion des Produits</h1>

    <button id="showCreateForm">Créer un Nouveau Produit</button>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
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
                <td>{{ $product->title }}</td> <!-- Corrected from 'name' to 'title' -->
                <td>{{ $product->content ?? 'Aucune description' }}</td> <!-- Corrected from 'description' to 'content' -->
                <td>{{ $product->price }} MAD</td>
                <td>{{ $product->stock }}</td> <!-- Corrected from 'quantity' to 'stock' -->
                <td>
                    <button class="deleteProduct" data-id="{{ $product->id }}">🗑️</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal pour la création d'un produit -->
    <div id="productModal" style="display:none;">
        <h5>Créer un Produit</h5>
        <form id="productForm">
            @csrf
            <div>
                <label>Nom</label>
                <input type="text" id="title" required> <!-- Corrected from 'name' to 'title' -->
            </div>
            <div>
                <label>Description</label>
                <textarea id="content"></textarea> <!-- Corrected from 'description' to 'content' -->
            </div>
            <div>
                <label>Prix</label>
                <input type="number" id="price" step="0.01" required>
            </div>
            <div>
                <label>Quantité</label>
                <input type="number" id="stock" required> <!-- Corrected from 'quantity' to 'stock' -->
            </div>
            <button type="submit">Créer</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Afficher le formulaire de création
        $('#showCreateForm').click(function() {
            $('#productForm')[0].reset();
            $('#productModal').show();
        });

        // Soumettre le formulaire pour créer un produit
        $('#productForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('products.store') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    title: $('#title').val(), // Corrected from 'name' to 'title'
                    content: $('#content').val(), // Corrected from 'description' to 'content'
                    price: $('#price').val(),
                    stock: $('#stock').val(), // Corrected from 'quantity' to 'stock'
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
                                <button class="deleteProduct" data-id="${product.id}">🗑️</button>
                            </td>
                        </tr>
                    `;
                    $('#productsTableBody').append(newRow); // Ajouter le produit à la table
                    alert("Produit créé avec succès !");
                    $('#productModal').hide(); // Masquer le modal
                },
                error: function(xhr) {
                    alert('Erreur: ' + xhr.responseJSON.message);
                }
            });
        });

        // Supprimer un produit
        $(document).on('click', '.deleteProduct', function() {
            if (!confirm('Confirmer la suppression ?')) return;

            let id = $(this).data('id');

            $.ajax({
                url: `/products/${id}`,
                type: 'DELETE',
                data: { _token: "{{ csrf_token() }}" },
                success: function() {
                    $(`#productRow${id}`).remove(); // Supprimer la ligne de la table
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
