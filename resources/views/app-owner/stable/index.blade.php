@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('owner-stable-approval') }}
@endsection

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
                    <h3 class="card-label font-weight-bolder text-dark">Stable Approval</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">List of stable approval</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <a href="{{ route('app_owner.stable.approval.step_1') }}">
                    <div class="card card-custom bg-hover-secondary text-hover-primary mb-2">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="fas fa-chess-knight"></i>
                                </span>
                                <h3 class="card-label">
                                    Stable Approval Step 1
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <div class="card-label">
                                    <span class="label label-light-info font-weight-bold">2</span>
                                </div>
                                <span class="card-icon align-items-center d-flex ml-3">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('app_owner.stable.approval.step_2') }}">
                    <div class="card card-custom bg-hover-secondary text-hover-primary mb-2">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="fas fa-chess-knight"></i>
                                </span>
                                <h3 class="card-label">
                                    Stable Approval Step 2
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <div class="card-label">
                                    <span class="label label-light-info font-weight-bold">2</span>
                                </div>
                                <span class="card-icon align-items-center d-flex ml-3">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection

@push('page-scripts')
<script>
    $('#datePicker').datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        autoclose: true,
        // language : 'id',
        format   : 'yyyy-mm-dd'
    });
</script>
@endpush