

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
function addToCart() {
    var product_name = $('#pname').text();
    var id = $('#product_id').val();
    var color = $('#color option:selected').text();
    var size = $('#size option:selected').text();
    var quantity = $('#quantity').val();


    $.ajax({
        method: "POST",
        dataType: "json",
        data: {
            product_name: product_name,
            id: id,
            color: color,
            size: size,
            quantity: quantity,
        },
        url: "/cart/data/store/" + id,
        success: function (data) {
            miniCart()
            couponCalculation();
            $('#closeModal').click();
            const toast = Swal.mixin({
                toast: false,
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 3500
            })
            if ($.isEmptyObject(data.error)) {
                toast.fire({
                    type: 'error',
                    'title': data.success
                })
            } else {
                toast.fire({
                    icon: 'error',
                    'title': data.error
                })
            }
        },

    })
}




function miniCart() {

    $.ajax({
        type: "GET",
        url: "/cart/data/read",
        dataType: 'json',
        success: function (response) {
            couponCalculation();
            $('span[id="cartSubTotal"]').text(response.cartTotal);
            $('#cartQty').text(response.cartQty);
            var miniCart = "";
            console.log(response.carts);
            if (response && response.cartQty > 0) {
                var cartTotalText = translations.subtotal + ' :';
                var checkoutText = translations.checkout;
                $.each(response.carts, function (key, value) {
                    miniCart += `<div class="cart-item product-summary">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                        <h3 class="name"><a href="product/details/"+${value.id}>${value.name}</a></h3>
                        <div class="price"> ${value.price} EUR * ${value.qty} </div>
                    </div>
                    <div class="col-xs-1 action"> <button type="submit" id="${value.rowId}" onclick="CartItemRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
                </div>
            </div>
            <!-- /.cart-item -->
            <div class="clearfix"></div>
            <hr>
            <div class="clearfix cart-total">
                <div class="pull-right"> <span class="text">${cartTotalText} :</span>
                    <span class='price'  id="cartSubTotal"> </span><span class='price'> ${response.cartTotal} EUR</span> </div>
                <div class="clearfix"></div>
                <a href="${checkoutRouteURL}" class="btn btn-upper btn-primary btn-block m-t-20">${checkoutText}</a>
            </div>`;
                });
                $('#miniCart').html(miniCart);
            } else {
                miniCart =
                    "<div class='empty-cart'><span class='alert alert-danger'>Your cart is empty.</span></div>";
                $('#miniCart').html(miniCart);
            }
        },
        error: function (error) {
            // Handle error
        }
    });
}
miniCart();



function CartItemRemove(rowId) {
    $.ajax({
        type: 'GET',
        url: '/cart/remove/item/' + rowId,
        dataType: 'json',
        success: function (data) {
            couponCalculation()
            miniCart();
            cart()
            // Start Message
            const Toast = Swal.mixin({
                toast: false,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000
            })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    title: data.success
                })
            } else {
                Toast.fire({
                    type: 'error',
                    title: data.error
                })
            }
            // End Message

        }
    });

}
function cart() {
    $.ajax({
        type: 'GET',
        url: '/get-cart-product',
        dataType: 'json',
        success: function (response) {


            couponCalculation()
            var rows = ""



            $.each(response.carts, function (key, value) {
                rows += `<tr>
        <td class="col-md-2"><img src="/${value.options.image} " alt="imga" style="width:60px; height:60px;"></td>
 <td class="col-md-2">
    <strong>${value.name} </strong>
    </td>
         <td class="col-md-2">
            <strong>${value.options.color} </strong>
            </td>
         <td class="col-md-2">
          ${value.options.size == null
                        ? `<span> .... </span>`
                        :
                        `<strong>${value.options.size} </strong>`
                    }
            </td>

<td class="col-md-2">
 ${value.qty > 1
                        ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" >-</button> `
                        : `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button> `
                    }

        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;" id="wish_qty" >
         <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)" >+</button>
            </td>
             <td class="col-md-2">
            <strong>$${value.subtotal} </strong>
            </td>


        <td class="col-md-1 close-btn">
            <button type="submit" class="" id="${value.rowId}" onclick="CartItemRemove(this.id)"><i class="fa fa-times"></i></button>
            </td>
                </tr>`
            });


            $('#cartPage').html(rows);

        }
    })
}
cart();



function cartIncrement(rowId) {
    var id = $('#wish_qty').val();
    console.log(id)
    $.ajax({
        type: 'GET',
        url: "/cart-increment/" + rowId,
        data: {
            id: id
        },
        dataType: 'json',
        success: function (data) {
            couponCalculation()
            cart();
            miniCart();
        }
    });
}


function cartDecrement(rowId) {
    $.ajax({
        type: 'GET',
        url: "/cart-decrement/" + rowId,
        dataType: 'json',
        success: function (data) {
            couponCalculation()
            cart();
            miniCart();
        }
    });
}
