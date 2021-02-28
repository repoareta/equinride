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
            <div class="card-header py-3 align-items-center">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Withdrawals</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">The preferred payment method is selected as Bank Transfer</span>
                </div>
                <a href='{{ route('stable.withdraw.create') }}' class='btn btn-primary ml-5'>Make a Withdraw</a>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="alert alert-custom alert-light-success fade show mb-10" role="alert">
                    <div class="alert-icon">
                        <i class="fas fa-wallet" aria-hidden="true"></i>
                    </div>
                    <div class="alert-text font-weight-bold font-size-h4">
                        Your currently balance is Rp. 9.000.000
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Withdrawal Method</th>
                                <th scope="col">Requested On</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
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
<!--End::dataTable-->
<script type="text/javascript">
$(document).ready( function () {
    var t = $('#dataTable').DataTable({
        scrollX   : true,
        processing: true,
        ordering: true,
        // serverSide: true,
        // ajax: {
        //     url : '{!! url()->current() !!}'
        // },
        // language: {
        //     processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
        // },
        // columns: [
        //     {
        //         "data": 'DT_RowIndex',
        //         orderable: false, 
        //         searchable: false
        //     },
        //     {data: 'withdrawal_method', name: 'withdrawal_method'},
        //     {data: 'created_at', name: 'created_at'},
        //     {data: 'amount', name: 'amount'},
        //     {data: 'status', name: 'status'},
        // ]
    });
});
</script>
@endpush