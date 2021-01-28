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
            <div class="card-body">                
                <div class="card mb-5">
                    <div class="card-header py-3">                    
                        <h4 class="font-weight-bolder text-dark mb-0">Unapproved</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-5">
                            <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTable">
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
                                <tbody>
                                    @for ($i = 1; $i < 20; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>Steven Stable</td>
                                        <td>
                                            <a target="_blank" href="{{ asset('assets/media/branchsto/Bukti-Transfer-ATM-BCA.jpg') }}">
                                                <img src="{{ asset('assets/media/branchsto/Bukti-Transfer-ATM-BCA.jpg') }}" style="max-width: 100px;">
                                            </a>
                                        </td>
                                        <td>Pending</td>
                                        <td>Steven Coa</td>
                                        <td>130910481</td>
                                        <td nowrap="nowrap">
                                            <a href="javascript:void(0)" data-id="{{ $i }}" class="btn btn-clean btn-icon mr-2" id="openBtn" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{ $i }}" class="btn btn-clean btn-icon mr-2" id="accept" title="Accept">
                                                <i class='fas fa-check-circle'></i>
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{ $i }}" class="btn btn-clean btn-icon mr-2" id="decline" title="Decline">
                                                <i class='fas fa-ban'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-5">
                    <div class="card-header py-3">                    
                        <h4 class="font-weight-bolder text-dark mb-0">Approved</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-5">
                            <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTableunapprov">
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
                                <tbody>
                                    @for ($i = 1; $i < 20; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>Steven Stable</td>
                                        <td>
                                            <a target="_blank" href="{{ asset('assets/media/branchsto/Bukti-Transfer-ATM-BCA.jpg') }}">
                                                <img src="{{ asset('assets/media/branchsto/Bukti-Transfer-ATM-BCA.jpg') }}" style="max-width: 100px;">
                                            </a>
                                        </td>
                                        <td>Pending</td>
                                        <td>Steven Coa</td>
                                        <td>130910481</td>
                                        <td nowrap="nowrap">
                                            <a href="javascript:void(0)" data-id="{{ $i }}" class="btn btn-clean btn-icon mr-2" id="openBtn" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
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
                                DETAIL STABLE
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <p class="mb-0">User</p>
                                    <h4 class="mb-4" id="user"></h4>                            
                                    <p class="mb-0">Image</p>
                                    <img src="" alt="" id="photo" width="100px" class="mb-4">
                                    <p class="mb-0">Bank Account Name</p>
                                    <h4 class="mb-4" id="bank_name"></h4>
                                    <p class="mb-0">Bank Account Number</p>
                                    <h4 class="mb-4" id="bank_number"></h4>
                                    <p class="mb-0">Package</p>
                                    <h4 class="mb-4" id="package"></h4>
                                    <p class="mb-0">Stable</p>
                                    <h4 class="mb-4" id="stable"></h4>
                                    <p class="mb-0">Status</p>
                                    <h4 class="mb-4" id="approval_status"></h4>
                                    <p class="mb-0">Payment Date & Time</p>
                                    <h4 class="mb-4" id="created_at"></h4>
                                    <p class="mb-0">Approval By</p>
                                    <h4 class="mb-4" id="approval_by"></h4>
                                    <p class="mb-0">Approval At</p>
                                    <h4 class="mb-4" id="approval_at"></h4>
                                </div>
                            </div>
                            <div class="modal-footer">											
                                <button data-dismiss="modal" class="btn btn-primary font-weight-bold">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
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
        $('#dataTable').DataTable({
            scrollX   : true,
            processing: true,
        }); 

        $('#dataTableunapprov').DataTable({
            scrollX   : true,
            processing: true,
        }); 

        $("tbody").on("click","#accept", function(e) {
                                
            e.preventDefault();
                
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                text: "This is will be accepted the stable",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Accept",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            })
        });
            
        $("tbody").on("click","#decline", function(e) {

            e.preventDefault();
                
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                text: "This is will be declined the stable",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Accept",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            })
        });
        $('body').on( 'click', '#openBtn', function () {
            var id = $(this).data('id');
            jQuery.noConflict();
            $('#modalDetail').modal('show');
        });              
    } );
</script>
@endpush