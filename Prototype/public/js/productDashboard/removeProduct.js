$(document).ready(function() {
    $(document).on('click', '.delete_product', function(e) {
        e.preventDefault();
        let product_id = $(this).data('id');

        if(confirm("are you sure??"))
        {
            let element = $(this).parent().parent();
            $.ajax({
                url: produitDeleteRoute +"/"+ product_id,
                method:'DELETE',
                data: {
                    _token: csrfToken,
                    product_id: product_id
                    },
                success: function(response) {
                    if(response.status == "success"){
                        element.remove();
                    }
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            })
        }
    })
});
