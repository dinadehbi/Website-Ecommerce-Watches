

$(document).ready(function() {
    $(document).on('click', '#add_product', function(e) {
        e.preventDefault();


        let name = $('#nom').val();
        let price = $('#prix').val();
        let stock = $('#stock').val();
        let content = $('#description').val();


        $.ajax({
            url:produitStoreRoute,
            method:'POST',
            data:{
                _token: csrfToken,
                name: name,
                price: price,
                stock: stock,
                content: content
                },
            success:function(response){
                let productId = response.product.id
                let newname = response.product.name
                let newprice = response.product.price
                let nemstock = response.product.stock
                $('#products_rows').append(`
                    <tr>
                        <td>${productId}</td>
                        <td> ${newname} </td>
                        <td> ${newprice} </td>
                        <td> ${nemstock} </td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm delete_product" data-id="${productId}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                `);
                $('#nom').val("");
                $('#prix').val("");
                $('#stock').val("");
                $('#description').val("");
            },
            error:function(xhr)
            {
                if (xhr.status === 422) {
                    $('#Errors').
                    children().remove();
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for (const key in errors) {
                        $('#Errors').append("<span class='text-danger'>"+errors[key][0]+"</span>"+"<br />");
                    }
                } else {
                    alert('Une erreur serveur est survenue.');
                }
                }
        })
    });
});
