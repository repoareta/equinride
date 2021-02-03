@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('profile-password') }}
@endsection

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
                    <table class="table table-separate table-head-custom table-checkable nowrap" id="dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Birth Date</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Experience</th>
                                <th scope="col">Certified</th>											
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
