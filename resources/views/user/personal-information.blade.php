@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('profile') }}
@endsection

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('user._aside')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <!--begin::Form-->
            <form class="form" action="{{ route('user.personal_information.update') }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="card-header d-flex justify-content-between py-3">
                <div class="card-title align-items-start flex-column mb-0">
                    <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Customer Info</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                        <div class="col-lg-9 col-xl-6">
                            @if ( !Auth::user()->photo )
                            <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url('{{ asset('assets/media/users/blank.png') }}')">
                                <div class="image-input-wrapper" style="background-image: none;"></div>                                
                            @else
                            <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url('{{ asset('assets/media/users/blank.png') }}')">
                                <div class="image-input-wrapper" style="background-image: url('{{ asset(Auth::user()->photo) }}')"></div>
                            @endif
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" name="profile_avatar_remove">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" value="{{ Auth::user()->name }}" name="name" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Sex</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="form-group">
                                <div class="radio-inline">
                                    <label class="radio">
                                    <input type="radio" name="sex" value="male" {{ Auth::user()->sex == 'male' ? 'checked' : ''}}>
                                    <span></span>Male</label>
                                    <label class="radio">
                                    <input type="radio" name="sex" value="female" {{ Auth::user()->sex == 'female' ? 'checked' : ''}}>
                                    <span></span>Female</label>														
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-phone"></i>
                                    </span>
                                </div>
                                <input type="number" min="0" name="phone" value="{{ Auth::user()->phone }}" class="form-control form-control-lg form-control-solid" placeholder="Phone" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Birth Date</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" name="birth_date" value="{{ date('D, M d, Y', strtotime(Auth::user()->birth_date)) }}" id="datePicker" class="form-control form-control-lg form-control-solid" autocomplete="off"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-calendar-check-o icon-lg"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Complete Address</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <textarea name="address" rows="5" class="form-control form-control-lg form-control-solid" autocomplete="off">{{ Auth::user()->address }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
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
        orientation: "bottom left",
        autoclose: true,
        format: {
            /*
            * Say our UI should display a week ahead,
            * but textbox should store the actual date.
            * This is useful if we need UI to select local dates,
            * but store in UTC
            */
            toDisplay: function (date, format, language) {
                var d = new Date(date);
                d.setDate(d.getDate());

                return d.toLocaleDateString('default', { 
                    weekday: 'short', 
                    year: 'numeric', 
                    month: 'short', 
                    day: '2-digit' 
                });
            },
            toValue: function (date, format, language) {
                var d = new Date(date);
                d.setDate(d.getDate());
                return new Date(d);
            }
        }
    });
</script>
@endpush