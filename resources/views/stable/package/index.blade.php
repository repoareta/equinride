@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-package') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Package Management</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Setting your package</span>
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
                                <th scope="col">Package Name</th>
                                <th scope="col">Package Number</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Attendance</th>
                                <th scope="col">Package Status</th>							
                                <th scope="col">Approval Status</th>							
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i < 20; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>Steven</td>
                                <td>2190311</td>
                                <td>This is the best package</td>
                                <td>100,000</td>
                                <td>1</td>
                                <td>Publish</td>
                                <td>Accepted</td>
                                <td nowrap="nowrap">
                                    <a href="{{ route('stable.package.edit', $i) }}" class="btn btn-clean btn-icon mr-2" title="Edit details">
                                        <i class="la la-edit icon-xl"></i>
                                    </a>

                                    <a href="javascript:;" class="btn btn-clean btn-icon mr-2" title="Delete details" id="deletePackage" data-id="{{ $i }}">
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
			processing: true
		});
        $("#dataTable_filter").append("<a href='{{ route('stable.package.create') }}' class='btn btn-primary ml-5'>Add New +</a>");

        $('#dataTable tbody').on( 'click', '#deletePackage', function (e) {
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
						url: "{{ route('stable.package.destroy') }}",
						type: 'DELETE',
						dataType: 'json',
						data: {
							"id": id,
							"_token": "{{ csrf_token() }}",
						},
						success: function () {
							Swal.fire({
								title: "Delete Data Package",
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