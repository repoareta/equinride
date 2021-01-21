@push('page-scripts')
<script type="text/javascript">
    $('#kt_datepicker_2').datepicker({
        todayHighlight: true,
        startDate: new Date(),
        orientation: "bottom left",
        autoclose: true,
        // language : 'id',
        format   : 'yyyy-mm-dd',
        container     : '.date'
    });

    $('#search_datepicker').datepicker({
        todayHighlight: true,
        startDate: new Date(),
        orientation: "bottom left",
        autoclose: true,
        format   : 'yyyy-mm-dd'
    });

    $('#datetimepicker3').datetimepicker({
        format: 'HH:mm'
    });
</script>
    
@endpush