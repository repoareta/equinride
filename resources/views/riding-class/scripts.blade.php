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

    $('#datetimepicker3').datetimepicker({
        format: 'HH:mm'
    });
});
</script>
    
@endpush