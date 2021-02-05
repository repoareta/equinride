@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('owner-stable-approval-step-1') }}
@endsection

@push('page-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
<style>
    .btn i {
        padding-right: 0 !important;
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
                    <h3 class="card-label font-weight-bolder text-dark">Stable Approval Step 1</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">List of stable data in approval step 1</span>
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
                        <span class="nav-text">Unpproved</span>
                        </a>
                       </li>
                      </ul>
                     </div>
                    </div>
                    <div class="card-body">
                     <div class="tab-content">
                      <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                        <div class="card mb-5">
                            <div class="card-header py-3">
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
                            <div class="card-header py-3">                    
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
                            <div class="card-header py-3">                    
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

            <!-- Modal -->
            <div class="modal fade" id="modalDetail"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h4 class="title-text " id="title_modal" data-state="add">
                                Detail Stable
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Stable Name</p>
                                    <h4 class="mb-4" id="name"></h4>
                                    <p class="mb-0">Owner</p>
                                    <h4 class="mb-4" id="owner"></h4>
                                    <p class="mb-0">Manager</p>
                                    <h4 class="mb-4" id="manager"></h4>
                                    <p class="mb-0">Contact Person</p>
                                    <h4 class="mb-4" id="contact_person"></h4>
                                    <p class="mb-0">Contact Number</p>
                                    <h4 class="mb-4" id="contact_number"></h4>
                                    <p class="mb-0">Capacity of Stable</p>
                                    <h4 class="mb-4" id="capacity_of_stable"></h4>
                                    <p class="mb-0">Capacity of Arena</p>
                                    <h4 class="mb-4" id="capacity_of_arena"></h4>
                                    <p class="mb-0">Number of Coach</p>
                                    <h4 class="mb-4" id="number_of_coach"></h4>
                                    <p class="mb-0">Address</p>
                                    <h4 class="mb-4" id="address"></h4>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-0">Province</p>
                                    <h4 class="mb-4" id="province"></h4>
                                    <p class="mb-0">City</p>
                                    <h4 class="mb-4" id="city"></h4>
                                    <p class="mb-0">District</p>
                                    <h4 class="mb-4" id="district"></h4>
                                    <p class="mb-0">Village</p>
                                    <h4 class="mb-4" id="village"></h4>
                                    <p class="mb-0">Logo</p>
                                    <img src="" alt="" id="logo" style="max-width: 100px">
                                    <p class="mb-0">Approval At</p>
                                    <h4 class="mb-4" id="approval_at"></h4>
                                    <p class="mb-0">Approval By</p>
                                    <h4 class="mb-4" id="approval_by"></h4>
                                    <p class="mb-0">Approval Status</p>
                                    <h4 class="mb-4" id="approval_status"></h4>
                                </div>
                            </div>                            
                        </div>
                        <div class="modal-footer">											
                            <button data-dismiss="modal" class="btn btn-primary font-weight-bold">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
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
            // serverSide: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
            },
            ajax      : "{{ route('app_owner.stable.approval.step_1.pending') }}",
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
            // serverSide: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
            },
            ajax      : "{{ route('app_owner.stable.approval.step_1.approved') }}",
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
            // serverSide: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> <br> Loading...'
            },
            ajax      : "{{ route('app_owner.stable.approval.step_1.unapproved') }}",
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

        $('body').on( 'click', '#openBtn', function () {
            var id = $(this).data('id');
            $.get('{{route('app_owner.stable.approval.step_1.index' )}}'+'/show/' + id , function (data) {
                    $('#name').html(data[0].name);
                    $('#owner').html(data[0].owner);
                    $('#manager').html(data[0].manager);
                    $('#contact_person').html(data[0].contact_person);
                    $('#contact_number').html(data[0].contact_number);
                    $('#capacity_of_stable').html(data[0].capacity_of_stable);
                    $('#capacity_of_arena').html(data[0].capacity_of_arena);
                    $('#number_of_coach').html(data[0].number_of_coach);
                    $('#address').html(data[0].address);
                    if(data[1][0].name == null){
                        $('#province').html('Empty');
                    }else{
                        $('#province').html(data[1][0].name);
                    }
                    if(data[1][1].name == null){
                        $('#city').html('Empty');
                    }else{                        
                        $('#city').html(data[1][1].name);
                    }
                    if(data[1][2].name == null){
                        $('#district').html('Empty');
                    }else{                        
                        $('#district').html(data[1][2].name);
                    }                    
                    if(data[1][3].name == null){
                        $('#village').html('Empty');
                    }else{                        
                        $('#village').html(data[1][3].name);
                    }
                    $('#logo').attr('src','{{asset('')}}'+(data[0].logo));
                    $('#approval_status').html(data[0].approval_status);
                    $('#approval_at').html(data[0].approval_at);                    
                    if(data[0].approval_at == null){
                        $('#approval_at').html('Need Approval');    
                    }
                    if(data[0].approval_by == null){
                        $('#approval_by').html('Need Approval');    
                    }else{
                        $('#approval_by').html(data[0].approvalby_stable.name);
                    }
                    if(data[0].approval_status == null){
                        $('#approval_status').html('Need Approval');    
                    }
                    jQuery.noConflict();
                    $('#modalDetail').modal('show');
                })
        });
    } );
</script>
@endpush