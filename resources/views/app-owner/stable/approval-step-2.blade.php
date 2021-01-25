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
                    <h3 class="card-label font-weight-bolder text-dark">Stable Approval Step 2</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">List of stable data in approval step 2</span>
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
                            <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTableunapprov">
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
                                    @for ($i = 1; $i < 20; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>Steven Stable</td>
                                        <td>Steven</td>
                                        <td>087744779090</td>
                                        <td>Steven Coa</td>
                                        <td>2020-06-06</td>
                                        <td>Pending</td>
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
                            <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTable">
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
                                    @for ($i = 1; $i < 20; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>Steven Stable</td>
                                        <td>Steven</td>
                                        <td>087744779090</td>
                                        <td>Steven Coa</td>
                                        <td>2020-06-06</td>
                                        <td>Email Sent</td>
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
                                    <p class="mb-0">Facilities</p>
                                    <h4 class="mb-4" id="facilities"></h4>
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