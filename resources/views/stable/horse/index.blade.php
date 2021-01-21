@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-horse') }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" type="text/css">
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
                    <h3 class="card-label font-weight-bolder text-dark">Horse Management</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Setting your horse</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-data table-striped" id="dataTable">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Horse Name</th>
                            <th scope="col">Birth Date</th>
                            <th scope="col">Age</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Passport Number</th>
                            <th scope="col">Horse Owner</th>
                            <th scope="col">Horse Breeds</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Steven</td>
                                <td>17-01-2011</td>
                                <td>10 years</td>
                                <td>Mare</td>
                                <td>1231390121</td>
                                <td>Agus</td>
                                <td>Not Found</td>
                                <td>
                                    <a href="{{route('stable.horse.edit',1)}}" class="btn btn-info text-center mr-2" data-id="1">
                                        <i class="fas fa-pen edit-horse pointer-link"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger text-center mr-2" id="deleteHorse" data-id="1" >
                                        <i class="fas fa-trash delete-horse pointer-link"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Steven</td>
                                <td>17-01-2011</td>
                                <td>10 years</td>
                                <td>Mare</td>
                                <td>1231390121</td>
                                <td>Agus</td>
                                <td>Not Found</td>
                                <td>
                                    <a href="{{route('stable.horse.edit',1)}}" class="btn btn-info text-center mr-2" data-id="1">
                                        <i class="fas fa-pen edit-horse pointer-link"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger text-center mr-2" id="deleteHorse" data-id="1" >
                                        <i class="fas fa-trash delete-horse pointer-link"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Steven</td>
                                <td>17-01-2011</td>
                                <td>10 years</td>
                                <td>Mare</td>
                                <td>1231390121</td>
                                <td>Agus</td>
                                <td>Not Found</td>
                                <td>
                                    <a href="{{route('stable.horse.edit',1)}}" class="btn btn-info text-center mr-2" data-id="1">
                                        <i class="fas fa-pen edit-horse pointer-link"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger text-center mr-2" id="deleteHorse" data-id="1" >
                                        <i class="fas fa-trash delete-horse pointer-link"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Steven</td>
                                <td>17-01-2011</td>
                                <td>10 years</td>
                                <td>Mare</td>
                                <td>1231390121</td>
                                <td>Agus</td>
                                <td>Not Found</td>
                                <td>
                                    <a href="{{route('stable.horse.edit',1)}}" class="btn btn-info text-center mr-2" data-id="1">
                                        <i class="fas fa-pen edit-horse pointer-link"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger text-center mr-2" id="deleteHorse" data-id="1" >
                                        <i class="fas fa-trash delete-horse pointer-link"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Steven</td>
                                <td>17-01-2011</td>
                                <td>10 years</td>
                                <td>Mare</td>
                                <td>1231390121</td>
                                <td>Agus</td>
                                <td>Not Found</td>
                                <td>
                                    <a href="{{route('stable.horse.edit',1)}}" class="btn btn-info text-center mr-2" data-id="1">
                                        <i class="fas fa-pen edit-horse pointer-link"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger text-center mr-2" id="deleteHorse" data-id="1">
                                        <i class="fas fa-trash delete-horse pointer-link"></i>
                                    </a>
                                </td>
                            </tr>
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

@push('scripts')
<!--Start::dataTable-->
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/crud/datatables/advanced/row-grouping.js')}}"></script>
<!--End::dataTable-->
<script type="text/javascript">
    $(document).ready( function () {
        var t = $('#dataTable').DataTable({
			scrollX   : true,
			processing: true
		});
        $("#dataTable_filter").append("<a href='{{route('stable.horse.create')}}' class='btn btn-primary ml-5'>Add New +</a>");

        $('#dataTable tbody').on( 'click', '#deleteHorse', function (e) {
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
						url: "{{ route('stable.horse.destroy') }}",
						type: 'DELETE',
						dataType: 'json',
						data: {
							"id": id,
							"_token": "{{ csrf_token() }}",
						},
						success: function () {
							Swal.fire({
								title: "Delete Data Horse",
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