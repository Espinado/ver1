$(document).ready(function () {
    $('#district').select2({
        placeholder: 'Select district',
        language: "fr",
        theme: "classic"
    });
    $('#division').select2({
        placeholder: 'Select division',
        language: "fr",
        theme: "classic"
    });
    $('#state').select2({
        placeholder: 'Select division',
        theme: "classic",
        language: "fr"
    });
    $('#division').on('change', function () {
        var division_id = $(this).val();
        if (division_id) {
            $.ajax({
                url: window.baseURL + '/division/district/ajax/' + division_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="district_id"]').html('');
                    $('select[name="state_id"]').html('');
                    $('select[name="district_id"]').append(
                        '<option value="" disabled="" selected="">Select it</option>'
                    );
                    $('select[name="state_id"]').append(
                        '<option value="" disabled="" selected="">Select it</option>'
                    );
                    $.each(data, function (key, value) {
                        $('select[name="district_id"]').append(
                            '<option value="' + value.id + '">' + value
                                .district_name + '</option>');
                    });
                },
            });
        } else {
            alert('danger');
        }
    })
    $('select[name="district_id"]').on('change', function () {
        var district_id = $(this).val();
        if (district_id) {
            $.ajax({
                url: window.baseURL + '/get/states/ajax/' + district_id,  
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="state_id"]').html('');
                    $('select[name="state_id"]').append(
                        '<option value="" disabled="" selected="">Select it</option>'
                    );
                    $.each(data, function (key, value) {
                        $('select[name="state_id"]').append(
                            '<option value="' + value.id + '">' + value
                                .state_name + '</option>');
                    });
                },
            });
        } else {
            alert('danger');
        }
    });
})
