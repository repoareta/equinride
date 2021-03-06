@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('order-history') }}
@endsection

@push('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endpush

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('user._aside')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom">
            
            <!--begin::Header-->
            <div class="card-header py-3 d-flex justify-content-between">
                <div class="card-title align-items-start flex-column mb-0">
                    <h3 class="card-label font-weight-bolder text-dark">Order History</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">This is all of your order history</span>
                </div>
            </div>
            <!--end::Header-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTables" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Package</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">Location</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
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
        var t = $('#dataTables').DataTable({
			scrollX   : true,
            processing: true,
            ordering: true,
            serverSide: true,
            "bDestroy": true,
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
				{data: 'package', name: 'package'},
				{data: 'id', name: 'id'},
				{data: 'created_at', name: 'created_at'},
				{data: 'price_total', name: 'price_total'},
				{data: 'order_location', name: 'order_location'},
				{data: 'approval_status', name: 'approval_status'},
				{data: 'action', name: 'action'},
			]
		});        
    } );
</script>
@endpush