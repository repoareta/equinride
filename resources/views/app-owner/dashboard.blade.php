@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('owner-dashboard') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Dashboard</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Dashboard of app owner</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form">
                <!--begin::Body-->
                <div class="card-body"></div>
                <!--end::Body-->
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection

@push('page-scripts')
<script src="{{ asset('assets/js/pages/custom/profile/profile.js') }}"></script>
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