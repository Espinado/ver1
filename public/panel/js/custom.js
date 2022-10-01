$(function () {
    'use strict';

    $('#datatable1').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: '{{ __('system.search') }}',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        }
    });

    $('#datatable2').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true
    });

    // Select2
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity
    });

});

$(".passingID").click(function () {
    $('#select_list').show();
    $('#select').empty();
    var parent_id = $(this).attr('data-parent_id');
    var parent_name = $(this).attr('data-parent_name');
    console.log(parent_id)
    console.log(parent_name)
    if (parent_id) {
        $("#select").append("<p>Undercategory for category: </p>" + parent_name + "");
        $('#select_list').hide();
        //  $("#parent_id").val(category_id);
        $("[name='parent_id']").val(parent_id);

    }


});
