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
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
                </div>
                <div class="card-toolbar">
                    <button type="reset" class="btn btn-success mr-2">Save Changes</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form">
                <div class="card-body">
                    <!--begin::Alert-->
                    <div class="alert alert-custom alert-light-danger fade show mb-10" role="alert">
                        <div class="alert-icon">
                            <span class="svg-icon svg-icon-3x svg-icon-danger">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo4/dist/assets/media/svg/icons/Code/Info-circle.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                                        <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
                                        <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="alert-text font-weight-bold">Warning! The changed password can't be used to log in anymore</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="ki ki-close"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!--end::Alert-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="password" class="form-control form-control-lg form-control-solid mb-2" name="old_password" value="" placeholder="Current password">                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="password" class="form-control form-control-lg form-control-solid" name="password" value="" placeholder="New password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">Verify Password</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" value="" placeholder="Confirm new password">
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
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