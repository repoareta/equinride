@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-schedule') }}
@endsection

@push('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
<style>
    .divider{
        width: 100%;
        height: 1px;
        background-color: #e0e0e0;
        margin: 1rem 0;
    }

</style>
@endpush

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('stable._aside')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Schedule Management</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Setting your schedule</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Filter-->
                <h5 class="title-text">Filter</h5>
                <div class="form-group mb-3 row">
                    <div class="col-md-6">
                        <label>Date Range</label>
                        <div class="input-daterange input-group" id="date_range_filter">
                            <input type="text" class="form-control" autocomplete="off" name="from_date" id="from_date">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-ellipsis-h"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="end_date" autocomplete="off" id="end_date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                    </div>
                </div>
                <div class="divider"></div>
                <!--end::Filter-->
                <div class="table-responsive">
                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time Start</th>
                                <th scope="col">Time End</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Capacity Booked</th>							
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i < 20; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>2021-01-22</td>
                                <td>08:00</td>
                                <td>09:00</td>
                                <td>5</td>
                                <td>1</td>
                                <td nowrap="nowrap">
                                    <a href="javascript:;" class="btn btn-clean btn-icon mr-2" id="editSchedule" title="Edit details">
                                        <i class="la la-edit icon-xl"></i>
                                    </a>

                                    <a href="javascript:;" class="btn btn-clean btn-icon mr-2" title="Delete details" id="deleteSchedule" data-id="{{ $i }}">
                                        <i class="la la-trash icon-lg"></i>
                                    </a>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Body-->
        </div>

        <!-- Modal Generate Schedule -->
        <div class="modal fade" id="modalGenerateSchedule"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h4 class="title-text " id="title_modal" data-state="add">
                            GENERATE SCHEDULE
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                            $time = date('H:i');
                        @endphp
                        <form action="" class="repeater" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-11">
                                    <label>Date</label>
                                    <div class="input-daterange input-group date_range">
                                        <input type="text" class="form-control" name="start" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-ellipsis-h"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="end" autocomplete="off">
                                    </div>
                                </div>	
                            </div>
                                <!--
                                    The value given to the data-repeater-list attribute will be used as the
                                    base of rewritten name attributes.  In this example, the first
                                    data-repeater-item's name attribute would become group-a[0][text-input],
                                    and the second data-repeater-item would become group-a[1][text-input]
                                -->
                            <div data-repeater-list="group-a">
                                <div data-repeater-item class="form-group row">											
                                    <div class="col-md-3">
                                        <label>Time Start</label>
                                        <input type="text" class="form-control" name="time1" id="timePickerGen1">
                                    </div>																								
                                    <div class="col-md-3">
                                        <label>Time End</label>
                                        <input type="text" class="form-control" name="time2" id="timePickerGen2">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Capacity</label>
                                        <input type="number" class="form-control" name="capacity" id="capacity">
                                    </div>
                                    <div class="col-md-3 align-self-end">
                                        <button data-repeater-delete type="button" class="btn btn-sm font-weight-bolder btn-light-danger">
                                            <i class="la la-trash-o"></i>Delete</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button data-repeater-create type="button" class="btn btn-sm font-weight-bolder btn-light-primary mt-repeater-add">
                                <i class="la la-plus"></i>Add</a>
                            </button>
                        </div>
                        <div class="modal-footer">											
                            <button data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">SAVE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Edit Schedule -->
        <div class="modal fade" id="modalPackageEdit"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h4 class="title-text " id="title_modal" data-state="add">
                            EDIT SCHEDULE
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                            $time = date('H:i');
                        @endphp
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-11">
                                    <label>Date</label>
                                    <input type="hidden" class="form-control" name="slot_id" id="slot_id">
                                    <div class="input-daterange input-group date_range">
                                        <input type="text" class="form-control" name="start" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-ellipsis-h"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="end" autocomplete="off">
                                    </div>
                                </div>	
                            </div>	
                            <div class="form-group row">											
                                <div class="col-4">
                                    <label>Time Start</label>
                                    <input type="text" class="form-control" name="time1" maxlength="5" id="timePickerGen1">
                                </div>																								
                                <div class="col-4">
                                    <label>Time End</label>
                                    <input type="text" class="form-control" name="time2" maxlength="5" id="timePickerGen2">
                                </div>
                                <div class="col-3">
                                    <label>Capacity</label>
                                    <input type="text" class="form-control" name="capacity" id="capacity">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">											
                            <button data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">SAVE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!--end::Content-->
</div>
@endsection

@push('page-scripts')
<script type="text/javascript">
    $(document).ready( function () {
        var t = $('#dataTable').DataTable({
			scrollX   : true,
            processing: true
        });
        
        // Filter Date
        $('#date_range_filter').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            autoclose: true,
            // language : 'id',
            format   : 'yyyy-mm-dd'
        });

        
        // Button Generate Schedule
        $("#dataTable_filter").append("<button class='btn btn-primary ml-3'  data-toggle='modal' data-target='#modalGenerateSchedule'>Generate Schedule</button>");

        // Generate Date
        $('.date_range').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            autoclose: true,
            // language : 'id',
            format   : 'yyyy-mm-dd',
            startDate: new Date(),
        });
    
        // Edit Schedule
        $('#dataTable tbody').on( 'click', '#editSchedule', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $('#modalPackageEdit').modal('show');
        });

        // Delete Schedule
        $('#dataTable tbody').on( 'click', '#deleteSchedule', function (e) {
			e.preventDefault();
			var id = $(this).attr('data-id');
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!" ,
				icon: "warning",
				confirmButtonText: "Delete",
				confirmButtonColor: '#141D31',
				showCancelButton: true,
				reverseButtons: true
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: "{{ route('stable.schedule.destroy') }}",
						type: 'DELETE',
						dataType: 'json',
						data: {
							"id": id,
							"_token": "{{ csrf_token() }}",
						},
						success: function () {
							Swal.fire({
								title: "Delete Data Schedule",
								text: "success",
								icon: "success",
								buttonsStyling: false,
								confirmButtonText: "Ok",
								customClass: {
									confirmButton: "btn btn-dark"
								}
							}).then(function() {
								location.reload();
							});
						},
						error: function () {
							alert("An error occurred, please try again later.");
						}
					});
				}
			});
        });
        
    } );
    // Create form repeater to generate a lot of schedule
    $('.repeater').repeater();

    // For time in generate schedule
    $.noConflict();
    jQuery(function($) {
        $("input[id=timePickerGen1]").each(function () {
            $(this).timepicker(
                {
                    minuteStep: 60,
                    defaultTime: "7:00",
                    showMeridian: !1,
                    snapToStep: !0
                }
            );
        });
        $("input[id=timePickerGen2]").each(function () {
            $(this).timepicker(
                {
                    minuteStep: 60,
                    defaultTime: "8:00",
                    showMeridian: !1,
                    snapToStep: !0
                }
            );
        });
        $('.mt-repeater-add').click(function(){
            $("input[id=timePickerGen1]").each(function () {
                $(this).timepicker(
                    {
                        minuteStep: 60,
                        defaultTime: "7:00",
                        showMeridian: !1,
                        snapToStep: !0
                    }
                );
            });
            $("input[id=timePickerGen2]").each(function () {
                $(this).timepicker(
                    {
                        minuteStep: 60,
                        defaultTime: "8:00",
                        showMeridian: !1,
                        snapToStep: !0
                    }
                );
            });
    
        })
    });
</script>
<!--Start::dataTable-->
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/advanced/row-grouping.js') }}"></script>
<!--End::dataTable-->
@endpush