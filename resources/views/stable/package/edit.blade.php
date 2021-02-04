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
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Edit your package</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" enctype="multipart/form-data" name="createform" id="createform" method="POST" action="{{ route('stable.package.update', $item->id) }}">
                @method('PUT')
                @csrf
                <!--begin::Body-->
                <input type="hidden" class="packageid" name="packageid" id="packageid" value="">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Photo</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="form-group">
                                <div id="dropzoneDragArea" class="dropzone dropzone-default dropzone-primary dz-clickable">                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Package Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name" value="{{ $item->name }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Package Number</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="number" min="0" name="package_number" value="{{ $item->package_number }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Description</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <textarea name="description" rows="5" class="form-control form-control-lg form-control-solid">{{ $item->description }}</textarea>
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
                                <input class="form-control form-control-lg form-control-solid" type="number" min="0" name="price" value="{{ $item->price }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Session Usage</label>
                        <div class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                <input type="radio" name="session_usage" value="Yes" {{ $item->session_usage == 'Yes' ? 'checked' : '' }}>
                                <span></span>Yes</label>
                                <label class="radio">
                                <input type="radio" name="session_usage" value="" {{ $item->session_usage == null ? 'checked' : '' }}>
                                <span></span>No</label>														
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Package Status</label>
                        <div class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                <input type="radio" name="status" value="Yes" {{ $item->package_status == 'Yes' ? 'checked' : '' }}>
                                <span></span>Publish</label>
                                <label class="radio">
                                <input type="radio" name="status" value="" {{ $item->package_status == null ? 'checked' : '' }}>
                                <span></span>No Publish</label>														
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Save</button>
                            <a href="{{ route('stable.package.index') }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back</a>
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
    Dropzone.autoDiscover = false;
    // Dropzone.options.createform = false;	
    let token = $('meta[name="csrf-token"]').attr('content');
    var dz = $("div#dropzoneDragArea").dropzone({
                paramName: "photo",
                url: "{{ route('stable.package.store_img') }}",                
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: false,
                parallelUploads: 1,
                maxFiles: 1,
                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;
                    //form submission code goes here
                    $("form[name='createform']").submit(function(event) {
                        //Make sure that the form isn't actully being sent.
                        event.preventDefault();

                        URL = $("#createform").attr('action');
                        formData = $('#createform').serialize();
                        
                        $.ajax({
                            type: 'POST',
                            url: URL,
                            data: formData,
                            success: function(result){
                                if(result.status == "success"){
                                    // fetch the useid 
                                    var packageid = result.packageid;
                                    $("#packageid").val(packageid); // inseting packageid into hidden input field
                                    if(myDropzone.files == ''){
                                        location.href = "{{ route('stable.package.index') }}";
                                    }
                                    //process the queue
                                    myDropzone.processQueue();
                                }else{
                                    console.log("error");
                                }
                            }
                        });
                    });

                    //Gets triggered when we submit the image.
                    this.on('sending', function(file, xhr, formData){
                        //fetch the user id from hidden input field and send that packageid with our image
                        let packageid = document.getElementById('packageid').value;
                        formData.append('packageid', packageid);
                    });
                    
                    this.on("success", function (file, response) {
                        location.href = "{{ route('stable.package.index') }}";
                    });
                }
            });
</script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\PackageStore') !!}
@endpush