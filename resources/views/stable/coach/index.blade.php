@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-coach') }}
@endsection

@push('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
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
                    <h3 class="card-label font-weight-bolder text-dark">Coach Management</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Setting your coach</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Coach Name</th>
                                <th scope="col">Birth Date</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Experience</th>
                                <th scope="col">Certified</th>											
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection

@push('page-scripts')
<!--Start::dataTable-->
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/advanced/row-grouping.js') }}"></script>
<!--End::dataTable-->
<script type="text/javascript">
    $(document).ready( function () {
        var t = $('#dataTable').DataTable({
			scrollX   : true,
            processing: true,
            ordering: true,
            serverSide: true,
            ajax: {
                url : '{!! url()->current() !!}'
            },
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
            },
            columns: [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },
				{data: 'name', name: 'name'},
				{data: 'birth_date', name: 'birth_date'},
				{data: 'age', name: 'age'},
				{data: 'sex', name: 'sex'},
				{data: 'experience', name: 'experience'},
				{data: 'certified', name: 'certified'},
				{data: 'action', name: 'action'},
			]
		});
        $("#dataTable_filter").append("<a href='{{ route('stable.coach.create') }}' class='btn btn-primary ml-5'>Add New +</a>");

        $('#dataTable tbody').on( 'click', '#deleteCoach', function (e) {
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
						url: "{{ route('stable.coach.destroy') }}",
						type: 'DELETE',
						dataType: 'json',
						data: {
							"id": id,
							"_token": "{{ csrf_token() }}",
						},
						success: function () {
							Swal.fire({
								title: "Delete Data Coach",
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
</script>
@endpush