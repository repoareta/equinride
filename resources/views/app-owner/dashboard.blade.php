@extends('layouts.app')

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
        <!--begin::Profile Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Body-->
            <div class="card-body pt-4">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end">
                    <div class="dropdown dropdown-inline">
                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover py-5">
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-drop"></i>
                                        </span>
                                        <span class="navi-text">New Group</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-list-3"></i>
                                        </span>
                                        <span class="navi-text">Contacts</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-rocket-1"></i>
                                        </span>
                                        <span class="navi-text">Groups</span>
                                        <span class="navi-link-badge">
                                            <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-bell-2"></i>
                                        </span>
                                        <span class="navi-text">Calls</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-gear"></i>
                                        </span>
                                        <span class="navi-text">Settings</span>
                                    </a>
                                </li>
                                <li class="navi-separator my-3"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-magnifier-tool"></i>
                                        </span>
                                        <span class="navi-text">Help</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-bell-2"></i>
                                        </span>
                                        <span class="navi-text">Privacy</span>
                                        <span class="navi-link-badge">
                                            <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                </div>
                <!--end::Toolbar-->
                <!--begin::User-->
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                        <div class="symbol-label" style="background-image:url('{{asset('assets/media/users/300_21.jpg')}}')"></div>
                        <i class="symbol-badge bg-success"></i>
                    </div>
                    <div>
                        <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">James Jones</a>
                        <div class="text-muted">Application Developer</div>
                    </div>
                </div>
                <!--end::User-->
                <!--begin::Contact-->
                <div class="py-9">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Email:</span>
                        <a href="#" class="text-muted text-hover-primary">matt@fifestudios.com</a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold mr-2">Phone:</span>
                        <span class="text-muted">44(76)34254578</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="font-weight-bold mr-2">Location:</span>
                        <span class="text-muted">Melbourne</span>
                    </div>
                </div>
                <!--end::Contact-->
                <!--begin::Nav-->
                <ul class="navi navi-bold navi-hover navi-active navi-link-rounded">
                    <li class="navi-item mb-2">
                        <a class="navi-link py-4 active" href="#">
                            <span class="navi-icon mr-2">
                                <i class="fas fa-chess-knight"></i>
                            </span>
                            <span class="navi-text">Stable</span>
                            <span class="navi-label">
                                <span class="label label-light-info font-weight-bold">2</span>
                            </span>
                            <span class="navi-arrow"></span>
                        </a>
                    </li>
                    <li class="navi-item mb-2">
                        <a class="navi-link py-4" href="#">
                            <span class="navi-icon mr-2">
                                <i class="flaticon2-layers-1"></i>
                            </span>
                            <span class="navi-text">Package</span>
                            <span class="navi-label">
                                <span class="label label-inline label-light-primary font-weight-bold">Updated</span>
                            </span>
                            <span class="navi-arrow"></span>
                        </a>
                    </li>
                    <li class="navi-item mb-2">
                        <a class="navi-link py-4" href="#">
                            <span class="navi-icon mr-2">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <span class="navi-text">Schedule</span>
                            <span class="navi-label">
                                <span class="label label-inline label-light-danger font-weight-bold">New</span>
                            </span>
                            <span class="navi-arrow"></span>
                        </a>
                    </li>

                    <li class="navi-section mt-5 text-primary text-uppercase font-weight-bolder pb-0">Settings</li>

                    <li class="navi-item mb-2">
                        <a class="navi-link py-4" href="#horseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <span class="navi-icon mr-2">
                                <i class="la la-horse-head icon-xl"></i>
                            </span>
                            <span class="navi-text">Horse</span>
                            <span class="navi-arrow"></span>
                        </a>

                        <ul class="collapse list-unstyled" id="horseSubmenu">
                            <li class="navi-item mb-2 pl-3">
                                <a class="navi-link py-4" href="#">
                                    <span class="navi-icon mr-2">
                                        <i class="la la-horse icon-xl"></i>
                                    </span>
                                    <span class="navi-text">Horse Sex</span>
                                </a>
                            </li>

                            <li class="navi-item mb-2 pl-3">
                                <a class="navi-link py-4" href="#">
                                    <span class="navi-icon mr-2">
                                        <i class="la la-horse icon-xl"></i>
                                    </span>
                                    <span class="navi-text">Horse Breed</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="navi-item mb-2">
                        <a class="navi-link py-4" href="#">
                            <span class="navi-icon mr-2">
                                <i class="la la-bank icon-xl"></i>
                            </span>
                            <span class="navi-text">Bank Payment</span>
                            <span class="navi-label">
                                <span class="label label-inline label-light-success font-weight-bold">Pending</span>
                            </span>
                            <span class="navi-arrow"></span>
                        </a>
                    </li>
                </ul>
                <!--end::Nav-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Profile Card-->
    </div>
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
                </div>
                <div class="card-toolbar">
                    <button type="reset" class="btn btn-success mr-2">Save Changes</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form">
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
                            <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url({{asset('assets/media/users/300_21.jpg')}})">
                                <div class="image-input-wrapper" style="background-image: url(/metronic/theme/html/demo4/dist/assets/media/users/300_21.jpg)"></div>
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
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Sex</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="form-group">
                                <div class="radio-inline">
                                    <label class="radio">
                                    <input type="radio" name="sex" value="male">
                                    <span></span>Male</label>
                                    <label class="radio">
                                    <input type="radio" name="sex" value="female">
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
                                <input type="number" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Birth Date</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" name="birth_date" id="datePicker" class="form-control form-control-lg form-control-solid"/>
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
                                <textarea name="address"rows="5" class="form-control form-control-lg form-control-solid"></textarea>
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

@push('scripts')
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