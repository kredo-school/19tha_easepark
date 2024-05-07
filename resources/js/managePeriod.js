$(function() {
    $('input[name="daterange"]').daterangepicker({
        autoUpdateInput: false,
        applyButtonClasses: "btn-blue",
        cancelButtonClasses: "btn-cancel"
    });

    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        $('#start-date').val(picker.startDate.format('YYYY/MM/DD'));
        $('#end-date').val(picker.endDate.format('YYYY/MM/DD'));
    });

    $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});