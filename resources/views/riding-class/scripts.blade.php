@push('page-scripts')
<script type="text/javascript">
// Shorthand for $( document ).ready()
$(function() {
    $('.select2').select2({
        placeholder: "Select Stable",
        width:"100%",
    });

    $('#date_start').datetimepicker({
        format: 'ddd, DD MMM YYYY',
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom'
        },
        minDate: new Date()
    });

    $('#date_start').val("{{ request()->input('date_start') }}");

    $('#datetimepicker3').datetimepicker({
        format: 'HH:mm'
    });
});

function bookNow(packageId) {
    alert(packageId);
    $('#date_start').datetimepicker('show');
    $('#package-booking-form-' + packageId).submit();
}
</script>
    
@endpush