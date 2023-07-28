
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function addToWishList(product_id) {
    Toast = Swal.mixin({
        toast: false,

        icon: 'success',
        showConfirmButton: false,
        timer: 6000,


    }),
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '/cart/addToWishlist/item/' + product_id,
            success: function (data) {

                Toast.fire({
                    type: 'success',
                    title: data.success
                })
            },
            error: function (error) {

                var errorText = $.parseJSON(error.responseText);
                Toast.fire({
                    icon: 'error',
                    title: errorText.error,

                })
            }
        })
}

function wishlist() {
    $.ajax({
        type: 'GET',
        url: '/get-wishlist-product',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $('#count_wishes').text(response.length)
            var rows = ""
            $.each(response, function (key, value) {
                rows += `<tr>
                    <td class="col-md-2"><img src="/${value.product.product_thambnail} " alt="imga"></td>
                    <td class="col-md-7">
                        <div class="product-name"><a href="#">${value.product.product_name}</a></div>

                        <div class="price">
                        ${value.product.discount_price == null
                        ? `${value.product.selling_price}`
                        :
                        `${value.product.discount_price} <span>${value.product.selling_price}</span>`
                    }

                        </div>
                    </td>
        <td class="col-md-2">
            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add to Cart </button>
        </td>
        <td class="col-md-1 close-btn">
           <button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
        </td>
                </tr>`
            });

            $('#wishlist').html(rows);
        }
    })
}
wishlist();

function wishlistRemove(id) {
    $.ajax({
        type: 'GET',
        url: '/wishlist-remove/' + id,
        dataType: 'json',
        success: function (data) {
            wishlist();
            // Start Message
            const Toast = Swal.mixin({
                toast: false,
                position: 'top-end',

                showConfirmButton: true,
                timer: 2500
            })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error
                })
            }
            // End Message
        }
    });
    wishlist();
}
