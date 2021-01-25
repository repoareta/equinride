@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('owner-bank') }}
@endsection

@push('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
<style>
    .btn i {
        padding-right: 0 !important;
    }
    .table > tbody > tr > td {
        vertical-align: middle;
    }

</style>
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
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Bank Account Management</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Setting bank</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Account Number</th>
                                <th scope="col">Account Name</th>
                                <th scope="col">Branch</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i < 4; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>1213914198741</td>
                                <td>Steven</td>
                                <td>BCA</td>
                                <td>
                                    <img src="{{ asset('assets/media/branchsto/bca-logo.png') }}" style="max-width: 200px">
                                </td>
                                <td nowrap="nowrap">
                                    <a href="javascript:;" data-id="{{ $i }}" id="editData" class="btn btn-clean btn-icon mr-2" title="Edit details">
                                        <i class="la la-edit icon-xl"></i>
                                    </a>

                                    <a href="javascript:;" class="btn btn-clean btn-icon mr-2" title="Delete details" id="deleteData" data-id="{{ $i }}">
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
            <!-- begin::Modal -->
            @include('app-owner.payment-setting-bank.create')
            @include('app-owner.payment-setting-bank.edit')
            <!--end::Modal-->
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

        $("#dataTable_filter").append("<button class='btn btn-primary ml-5' data-toggle='modal' data-target='#modalAdd'>Add New +</button>");		

		$('#dataTable tbody').on( 'click', '#deleteData', function (e) {
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
			})
		});

		$('body').on('click', '#editData', function () {
            var id = $(this).data('id');

            jQuery.noConflict();
            $('#modalEdit').modal('show');
        });
    } );
</script>
@endpush