// checkout.js
$(document).ready(function () {
    // ... (rest of the code)
    $('#division').select2();
    $('#district').select2();

    $('#delivery_cost').html('0.00 EUR');
    $('#shipping_cost').val('0.00');

    // Function to update the total cost
    function updateTotalCost() {
        const sum = parseFloat($('#sum').text());
        const deliveryCost = parseFloat($('#delivery_cost').text());

        // Check if deliveryCost is a valid number
        if (!isNaN(deliveryCost)) {
            const fullTotal = sum + deliveryCost;
            $('#full_total').text(fullTotal.toFixed(2));
        }
    }

    // Function to update the district list based on selected division
    function updateDistrictList(division_id) {
        if (division_id) {
            $.ajax({
                url: window.baseURL + '/division/district/ajax/' + division_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#district').empty();

                    $.each(data, function (key, value) {
                        $('#district').append(
                            '<option value="' + value.id + '">' + value.district_name + '</option>'
                        );
                    });

                    // Refresh the select2 dropdown
                    $('#district').trigger('change');
                },
                error: function (error) {
                    console.log("Error retrieving districts:", error);
                }
            });
        } else {
            alert('Please select a valid division.');
        }
    }

    // Call the function on page load to update the district list based on the default selected division
    var defaultDivisionId = $('select[name="division_id"]').val();
    updateDistrictList(defaultDivisionId);

    $('select[name="division_id"]').on('change', function () {
        var division_id = $(this).val();
        // Call the function to update the district list based on the selected division
        updateDistrictList(division_id);
    });

    $('select[name="district_id"]').on('change', function () {
        var divisionId = $('select[name="division_id"]').val();
        var districtId = $(this).val();

        if (districtId) {
            $.ajax({
                url: window.baseURL + '/get/district/delivery/rates/' + divisionId + '/' + districtId,
                type: "GET",
                dataType: "json",
                success: function (rate) {
                    console.log(rate.delivery_cost);

                    // Convert rate.delivery_cost to a number
                    const deliveryCost = parseFloat(rate.delivery_cost);

                    // Check if deliveryCost is a valid number
                    if (!isNaN(deliveryCost)) {
                        $('#shipping_cost').val(deliveryCost.toFixed(2));
                        $('#delivery_cost').html(deliveryCost.toFixed(2) + ' EUR');
                        updateTotalCost();
                    } else {
                        console.log("Invalid delivery cost:", rate.delivery_cost);
                    }
                },
                error: function (error) {
                    console.log("Error retrieving delivery rate:", error);
                }
            });
        } else {
            $('#delivery_cost').html('0.00 EUR'); // Reset delivery cost when no district is selected
            $('#shipping_cost').val('0.00');
            updateTotalCost();
        }
    });

    $('input[name="shipping_method"]').on('change', function () {
        const selectedShippingMethod = $('input[name="shipping_method"]:checked').val();
        const deliveryCost = parseFloat($('input[name="shipping_method"]:checked').data('cost'));

        if (selectedShippingMethod === 'self') {
            $('#delivery_cost').html('0.00 EUR');
            $('#shipping_cost').val('0.00');
            updateTotalCost();
        } else if (!isNaN(deliveryCost)) {
            $('#delivery_cost').html(deliveryCost.toFixed(2) + ' EUR');
            $('#shipping_cost').val(deliveryCost.toFixed(2));
            updateTotalCost();
        } else {
            console.log("Invalid delivery cost:", deliveryCost);
        }
    });
});
