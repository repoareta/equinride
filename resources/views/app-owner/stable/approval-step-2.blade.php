@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('owner-stable-approval-step-2') }}
@endsection

@push('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endpush

@section('content')
<style>
    .btn i {
        padding-right: 0 !important;
    }

    .dataTables_wrapper table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child:before {
        margin-top: -5px;
    }
</style>
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
                    <h3 class="card-label font-weight-bolder text-dark">Stable Approval Step 2</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">List of stable data in approval step 2</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body p-0">
                <div class="card card-custom">
                    <div class="card-header card-header-tabs-line">
                     <div class="card-toolbar">
                      <ul class="nav nav-tabs nav-bold nav-tabs-line">
                       <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                        <span class="nav-icon"><i class="flaticon2-hourglass-1"></i></span>
                        <span class="nav-text">Pending</span>
                        </a>
                       </li>
                       <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                        <span class="nav-icon"><i class="fas fa-check-circle"></i></span>
                        <span class="nav-text">Approved</span>
                        </a>
                       </li>
                       <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
                        <span class="nav-icon"><i class="fas fa-ban"></i></span>
                        <span class="nav-text">Unapproved</span>
                        </a>
                       </li>
                      </ul>
                     </div>
                    </div>
                    <div class="card-body p-0">
                     <div class="tab-content">
                      <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                        <div class="card mb-5">
                            <div class="card-header py-5">
                                <h4 class="font-weight-bolder text-dark mb-0">Pending</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mb-5">
                                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTablePending">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Stable Name</th>
                                                <th scope="col">Owner</th>		
                                                <th scope="col">Contact Person</th>
                                                <th scope="col">Contact Number</th>
                                                <th scope="col">Date Created</th>
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
                      <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                        <div class="card mb-5">
                            <div class="card-header py-5">                    
                                <h4 class="font-weight-bolder text-dark mb-0">Approved</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mb-5">
                                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTableApproved">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Stable Name</th>
                                                <th scope="col">Owner</th>		
                                                <th scope="col">Contact Person</th>
                                                <th scope="col">Contact Number</th>
                                                <th scope="col">Date Created</th>
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
                      <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
                        <div class="card mb-5">
                            <div class="card-header py-5">                    
                                <h4 class="font-weight-bolder text-dark mb-0">Unapproved</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mb-5">
                                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTableUnapproved">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Stable Name</th>
                                                <th scope="col">Owner</th>
                                                <th scope="col">Contact Person</th>
                                                <th scope="col">Contact Number</th>
                                                <th scope="col">Date Created</th>
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
                     </div>
                    </div>
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
        
        $('#dataTablePending').DataTable({
            scrollX   : true,
            processing: true,
            responsive: true,
            // serverSide: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
            },
            ajax : {
                "url": "{{ route('app_owner.stable.approval.step_2.json_step_two') }}",
                "data": {
                    "approval_status": "Step 2 Need Approval"
                }
            },
            columns: [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {data: 'owner', name: 'owner'},
                {data: 'contact_person', name: 'contact_person'},
                {data: 'contact_number', name: 'contact_number'},
                {data: 'created_at', name: 'created_at'},
                {data: 'approval_status', name: 'approval_status'},
                {data: 'action', name: 'action'},
            ]
        });

        $('#dataTableApproved').DataTable({
            scrollX   : true,
            processing: true,
            responsive: true,
            // serverSide: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
            },
            ajax : {
                "url": "{{ route('app_owner.stable.approval.step_2.json_step_two') }}",
                "data": {
                    "approval_status": "Step 2 Approved"
                }
            },
            columns: [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {data: 'owner', name: 'owner'},
                {data: 'contact_person', name: 'contact_person'},
                {data: 'contact_number', name: 'contact_number'},
                {data: 'created_at', name: 'created_at'},
                {data: 'approval_status', name: 'approval_status'},
                {data: 'action', name: 'action'},
            ]
        });

        $('#dataTableUnapproved').DataTable({
            scrollX   : true,
            processing: true,
            responsive: true,
            // serverSide: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
            },
            ajax : {
                "url": "{{ route('app_owner.stable.approval.step_2.json_step_two') }}",
                "data": {
                    "approval_status": "Step 2 Decline"
                }
            },
            columns: [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {data: 'owner', name: 'owner'},
                {data: 'contact_person', name: 'contact_person'},
                {data: 'contact_number', name: 'contact_number'},
                {data: 'created_at', name: 'created_at'},
                {data: 'approval_status', name: 'approval_status'},
                {data: 'action', name: 'action'},
            ]
        });                
        
    });
</script>
@endpush