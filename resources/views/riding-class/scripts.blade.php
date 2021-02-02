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
    var date_start = $('#package-booking-form-' + packageId + " input[name='date_start']").val();
    var time_start = $('#package-booking-form-' + packageId + " input[name='time_start']").val();
    if(date_start === ""){
        Swal.fire({
            title  : 'Warning',
            text   : 'Please select Date and re-submit Search form',
            icon   : 'warning',
            buttons: true
        }).then(function(value){
            $('#date_start').datetimepicker('show');
        });
    } else if (time_start === "") {
        Swal.fire({
            title  : 'Warning',
            text   : 'Please select Time and re-submit Search form',
            icon   : 'warning',
            buttons: true
        }).then(function(value){
            $('#datetimepicker3').datetimepicker('show');
        });
    } else {
        $('#package-booking-form-' + packageId).submit();
    }
}
</script>
    
@endpush