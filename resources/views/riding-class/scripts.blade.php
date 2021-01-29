@push('page-scripts')
<script type="text/javascript">
// Shorthand for $( document ).ready()
$(function() {
    $('.select2').select2({
        placeholder: "Select Stable",
        width:"100%",
    });

    $('#kt_datepicker_2').datetimepicker({
        format: 'ddd, DD MMM YYYY',
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom'
        }
    });

    $('#search_datepicker').datepicker({
        todayHighlight: true,
        startDate: new Date(),
        orientation: "bottom left",
        autoclose: true,
        format: {
            /*
            * Say our UI should display a week ahead,
            * but textbox should store the actual date.
            * This is useful if we need UI to select local dates,
            * but store in UTC
            */
            toDisplay: function (date, format, language) {
                var d = new Date(date);
                d.setDate(d.getDate());

                return d.toLocaleDateString('default', { 
                    weekday: 'short', 
                    year: 'numeric', 
                    month: 'short', 
                    day: '2-digit' 
                });
            },
            toValue: function (date, format, language) {
                var d = new Date(date);
                d.setDate(d.getDate());
                return new Date(d);
            }
        }
    });

    $('#search_datepicker').on('changeDate', function(e){
        // console.log( moment(e.date).format('YYYY-MM-DD') );
        $('#search_datepicker_store').val( moment(e.date).format('YYYY-MM-DD') );
    });

    $('#datetimepicker3').datetimepicker({
        format: 'HH:mm'
    });
});
</script>
    
@endpush