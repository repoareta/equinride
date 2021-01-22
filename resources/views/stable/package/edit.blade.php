@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-package-edit') }}
@endsection

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('stable._aside')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Edit Package</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Edit your new package</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" enctype="multipart/form-data">
                <!--begin::Body-->
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
                        <div class="col-lg-9 col-xl-6">
                            <div id="dropZone" class="dropzone dropzone-default dropzone-primary dz-clickable">
                                <div class="fallback">
                                    <input name="file" type="file"  />
                                </div>
                            </div>
                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Package Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Package Number</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="number" min="0" name="package_number"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Description</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <textarea name="description" rows="5" class="form-control form-control-lg form-control-solid"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Price</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-append">
                                    <span class="input-group-text">RP</span>
                                </div>
                                <input class="form-control form-control-lg form-control-solid" type="number" min="0" name="price"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Attendance</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="number" min="0" name="attendance"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Session Usage</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="form-group">
                                <div class="radio-inline">
                                    <label class="radio">
                                    <input type="radio" name="session_usage" value="yes">
                                    <span></span>Yes</label>
                                    <label class="radio">
                                    <input type="radio" name="session_usage" value="">
                                    <span></span>No</label>														
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Package Status</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="form-group">
                                <div class="radio-inline">
                                    <label class="radio">
                                    <input type="radio" name="session_usage" value="Yes">
                                    <span></span>Publish</label>
                                    <label class="radio">
                                    <input type="radio" name="session_usage" value="">
                                    <span></span>No Publish</label>														
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9 text-right">
                            <a href="{{ route('stable.package.index') }}" class="btn btn-warning" type="submit">
                                Back
                            </a>
                            <button class="btn btn-primary" type="submit">
                                Save
                            </button>
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
        $("#dropZone").dropzone({ 
            url: "https://keenthemes.com/scripts/void.php",
            paramName: "file",
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            accept: function(e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
            }
        });
    </script>
@endpush