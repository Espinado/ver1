function productView(id) {

    $.ajax({
        type: 'GET',
        url: '/product/view/modal/' + id,
        dataType: 'json',
        success: function (data) {
            console.log(data.product);
            $('#oldprice').empty();
            $('#oldprice').empty();
            $('#pname').text(data.product.product_name);
            $('#product_id').val(data.product.id);
            $('#price').text(data.product.selling_price + ' EUR');
            $('#pcode').text(data.product.product_code);
            $("#quantity").prop('max', data.product.product_qty);
            if (data.product.product_qty > 0) {
                $('#available').text(data.product.product_qty);
                $('#notavailable').text('');
            } else {
                $('#available').text('');
                $('#notavailable').text('Not in stock');
            }
            $('#pcategory').text(data.product.category_name);
            $('#pbrand').text(data.product.brand_name);
            $('#pimage').attr('src', '/' + data.product.product_thambnail);
            if (data.product.discount_price == null) {
                $('#pprice').text(data.product.selling_price);
                $('#oldprice').text('');
            } else {
                $('#pprice').text(data.product.discount_price + ' EUR');
                $('#oldprice').text(data.product.selling_price + ' EUR');
            }
            $('select[name="color"]').empty();
            $.each(data.color, function (key, value) {
                $('select[name="color"]').append('<option value="' + value + '">' + value +
                    '</option>');
            })
            $('select[name="size"]').empty();
            $.each(data.size, function (key, value) {
                $('select[name="size"]').append('<option value="' + value + '">' + value +
                    '</option>');
                if (data.size == "") {
                    $('#sizeArea').hide();
                } else {
                    $('#sizeArea').show();
                }
            })
        }
    })
}
