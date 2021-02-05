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
                    <h3 class="card-label font-weight-bolder text-dark">Payment Package</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Verification of payment package</span>
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
                                            <th scope="col">User</th>
                                            <th scope="col">Image</th>													
                                            <th scope="col">Status</th>													
                                            <th scope="col">Bank Account Name</th>													
                                            <th scope="col">Bank Account Number</th>								
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
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
                                            <th scope="col">User</th>
                                            <th scope="col">Image</th>													
                                            <th scope="col">Status</th>													
                                            <th scope="col">Bank Account Name</th>													
                                            <th scope="col">Bank Account Number</th>								
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
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
                                            <th scope="col">User</th>
                                            <th scope="col">Image</th>													
                                            <th scope="col">Status</th>													
                                            <th scope="col">Bank Account Name</th>													
                                            <th scope="col">Bank Account Number</th>								
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
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
                        <div class="modal-header">
                            <h4 class="title-text " id="title_modal" data-state="add">
                                Detail Package
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-0">Package Number</p>
                                    <h4 class="mb-4" id="package_number"></h4>
                                    <p class="mb-0">Owner</p>
                                    <h4 class="mb-4" id="owner"></h4>
                                    <p class="mb-0">Name</p>
                                    <h4 class="mb-4" id="name"></h4>
                                    <p class="mb-0">Description</p>
                                    <h4 class="mb-4" id="description"></h4>
                                    <p class="mb-0">Price</p>
                                    <h4 class="mb-4" id="price"></h4>
                                    <p class="mb-0">Approval At</p>
                                    <h4 class="mb-4" id="approval_at"></h4>
                                </div>
                                <div class="col-sm-6">
                                    <p class="mb-0">Approval By</p>
                                    <h4 class="mb-4" id="approval_by"></h4>
                                    <p class="mb-0">Approval Status</p>
                                    <h4 class="mb-4" id="approval_status"></h4>
                                    <p class="mb-0">Image</p>
                                    <img src="" alt="" style="max-width: 100px;" id="photo">
                                    <p class="mb-0">Stable</p>
                                    <h4 class="mb-4" id="stable"></h4>
                                    <p class="mb-0">Attendance</p>
                                    <h4 class="mb-4" id="attendance"></h4>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">											
                            <button data-dismiss="modal" class="btn btn-add-new font-weight-bold">Close</button>
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
            ajax      : "{{ route('app_owner.payment.pending') }}",
            columns: [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {data: 'photo', name: 'photo'},
                {data: 'approval_status', name: 'approval_status'},
                {data: 'account_name', name: 'account_name'},
                {data: 'account_number', name: 'account_number'},                
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
            ajax      : "{{ route('app_owner.payment.approved') }}",
            columns: [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {data: 'photo', name: 'photo'},
                {data: 'approval_status', name: 'approval_status'},
                {data: 'account_name', name: 'account_name'},
                {data: 'account_number', name: 'account_number'},                
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
            ajax      : "{{ route('app_owner.payment.unapproved') }}",
            columns: [
                {
                    "data": 'DT_RowIndex',
                    orderable: false, 
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {data: 'photo', name: 'photo'},
                {data: 'approval_status', name: 'approval_status'},
                {data: 'account_name', name: 'account_name'},
                {data: 'account_number', name: 'account_number'},                
                {data: 'action', name: 'action'},
            ]
        }); 

        $('body').on('click', '#openBtn', function () {
            var id = $(this).data('id');
            $.get('{{route('app_owner.payment.verification')}}'+'/show/' + id , function (data) {
                $('#package_number').html(data.package_number);
                $('#name').html(data.name);
                if(data.user_id == null){
                    $('#owner').html('Something when wrong');
                }else{
                    $('#owner').html(data.user.name);
                }
                $('#description').html(data.description);
                $('#price').html(data.price);
                $('#photo').attr('src','{{asset("storage/package/photo/")}}/'+(data.photo));
                $('#approval_at').html(data.approval_at);
                if(data.approval_by == null){
                    $('#approval_by').html('Need Approval');    
                }else{
                    $('#approval_by').html(data.approvalby_package.name);
                }
                $('#approval_status').html(data.approval_status);
                if(data.approval_at == null){
                    $('#approval_at').html('Need Approval');    
                }
                if(data.approval_status == null){
                    $('#approval_status').html('Need Approval');    
                }                    
                $('#stable').html(data.stable_name);
                $('#attendance').html(data.attendance);
                jQuery.noConflict();
                $('#modalDetail').modal('show');
            })
        });      
    } );
</script>
@endpush