@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('owner-admin') }}
@endsection

@push('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endpush

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('app-owner._aside')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3 align-items-center">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Admin Management</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Setting your admin</span>
                </div>
                <a href='{{ route('app_owner.admin.create') }}' class='btn btn-primary ml-5 font-weight-bold'><span class="mr-2">Add New</span><i class="fas fa-plus icon-nm"></i></a>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Admin</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>											
                                <th scope="col">Address</th>											
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
				{data: 'user', name: 'user'},
				{data: 'sex', name: 'sex'},
				{data: 'email', name: 'email'},
				{data: 'phone', name: 'phone'},
				{data: 'address', name: 'address'},
				{data: 'action', name: 'action'},
			]
		});

        $('#dataTable tbody').on( 'click', '#deleteAdmin', function (e) {
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
						url: "{{ route('app_owner.admin.destroy') }}",
						type: 'DELETE',
						dataType: 'json',
						data: {
							"id": id,
							"_token": "{{ csrf_token() }}",
						},
						success: function () {
							Swal.fire({
								title: "Delete Data Admin",
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