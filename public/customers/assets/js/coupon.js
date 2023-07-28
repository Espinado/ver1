$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function applyCoupon() {
    var coupon_name = $('#coupon_name').val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: window.baseURL + '/coupons/apply',
        data: {
            coupon_name: coupon_name
        },
        success: function (data) {

            if (data.validity == true) {
                $('#couponField').hide();
                couponCalculation();

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

            } else {
                const Toast = Swal.mixin({
                    toast: false,
                    position: 'top-end',
                    showConfirmButton: true,
                    timer: 2000
                })
                Toast.fire({

                    icon: 'error',
                    title: data.error
                })
            }

        },
        error: function (error) {
            alert(error.error);
        }
    })

    //--Apply coupon end
}






        function couponCalculation() {
            $.ajax({
                type: 'GET',
                url: window.baseURL + '/coupons/calculate',
                dataType: 'json',
                success: function(data) {

                    if (data.total) {

                        $('#couponCalc').html(
                            `<tr>
                <th>
                    <div class="cart-sub-total">
                        Subtotal<span class="inner-left-md">$ ${data.total}</span>
                    </div>
                    <div class="cart-grand-total">
                        Grand Total<span class="inner-left-md">$ ${data.total}</span>
                    </div>
                </th>
            </tr>`
                        )
                    } else {
                        $('#couponCalc').html(
                            `<tr>
        <th>
            <div class="cart-sub-total">
                Subtotal&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="inner-left-md">$ ${data.subtotal}</span>
            </div>
            <div class="cart-sub-total">
                Coupon<span class="inner-left-md"> ${data.coupon_name} ${data.coupon_discount} %</span>
                <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i>  </button>
            </div>
             <div class="cart-sub-total">
                Discount Amount&nbsp&nbsp&nbsp&nbsp&nbsp<span class="inner-left-md">$ ${data.discount_amount}</span>
            </div>

            <div class="cart-grand-total">
                Grand Total&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="inner-left-md">$ ${data.total_amount}</span>
            </div>
        </th>
            </tr>`
                        )
                    }
                }

            });
        }
        couponCalculation();


        function couponRemove() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: window.baseURL + '/coupons/remove',
                success: function(success) {
                    couponCalculation();
                    $('#coupon_name').val('');
                    $('#couponField').show();
                    const Toast = Swal.mixin({
                        toast: false,
                        position: 'top-end',

                        showConfirmButton: true,
                        timer: 2500
                    })
                    if ($.isEmptyObject(success.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: success.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: success.error
                        })
                    }
                },

            })
        }

