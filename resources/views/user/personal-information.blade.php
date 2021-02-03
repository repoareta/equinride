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
            <div class="card-header d-flex justify-content-between py-3">
                <div class="card-title align-items-start flex-column mb-0">
                    <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
                </div>
            </div>
            <!--end::Header-->
                <!--begin::Body-->
                <form class="form" action="{{ route('user.personal_information.update') }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    @if ($message = Session::get('warning'))
                    <div class="alert alert-custom alert-light-warning fade show mb-10" role="alert">
                        <div class="alert-icon">
                            <span class="svg-icon svg-icon-3x svg-icon-warning">
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
                        <div class="alert-text font-weight-bold">
                            {{ $message }}
                        </div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="ki ki-close"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                    @endif
                    
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
                        <label class="col-12 col-lg-3 col-form-label">Sex</label>
                        <div class="col-9 col-form-label">
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

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Weight</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="number" min="0" name="weight" value="{{ Auth::user()->weight }}" class="form-control form-control-lg form-control-solid" placeholder="Weight" autocomplete="off"/>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        kg
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Height</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="number" min="0" name="height" value="{{ Auth::user()->height }}" class="form-control form-control-lg form-control-solid" placeholder="Height" autocomplete="off"/>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        cm
                                    </span>
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
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control form-control-lg form-control-solid" placeholder="Phone" autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Birth Date</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input 
                                type="text" 
                                name="birth_date" 
                                id="birth_date"
                                value="{{ date('D, d M Y', strtotime(Auth::user()->birth_date)) }}"
                                readonly="readonly" 
                                autocomplete="off"
                                placeholder="Select Date"
                                data-target="#birth_date"
                                data-toggle="datetimepicker"
                                class="form-control form-control-lg form-control-solid datetimepicker-input" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-calendar-check-o icon-lg"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Address</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <textarea name="address" rows="5" class="form-control form-control-lg form-control-solid" autocomplete="off">{{ Auth::user()->address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Save</button>
                            <button type="reset" class="btn btn-secondary"><i class="fas fa-times"></i> Reset</button>
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
<script>
    $(function() {

    $('#birth_date').datetimepicker({
        format: 'ddd, DD MMM YYYY',
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom'
        },
        date: "{{ date('D, d M Y', strtotime(Auth::user()->birth_date)) }}",
        useCurrent: false
    });

    $('#birth_date').val("{{ date('D, d M Y', strtotime(Auth::user()->birth_date)) }}");
});
</script>
@endpush