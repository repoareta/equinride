@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-coach-edit') }}
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" type="text/css">
@endpush

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
                    <h3 class="card-label font-weight-bolder text-dark">Edit Coach</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Edit your new coach</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" method="post" name="createform" id="createform" action="{{ route('stable.coach.update', $item->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <!--begin::Body-->
                <input type="hidden" class="coachid" name="coachid" id="coachid" value="">
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
                        <label class="col-xl-3 col-lg-3 col-form-label">Coach Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name" value="{{ $item->name }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Birth Date</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input type="text" name="birth_date" id="datePicker" class="form-control form-control-lg form-control-solid" value="{{ date('D, d M Y', strtotime($item->birth_date)) }}"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-calendar-check-o icon-lg"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" name="sex">
                                <option value="Female" {{ $item->sex == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Male" {{ $item->sex == 'Female' ? 'selected' : '' }}>Male</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Number</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-phone"></i>
                                    </span>
                                </div>
                                <input type="text" name="contact_number" class="form-control form-control-lg form-control-solid" placeholder="Phone" autocomplete="off" value="{{ $item->contact_number }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Experience</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="number" name="experience" min="0" class="form-control form-control-lg form-control-solid" value="{{ $item->experience }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Certified</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" name="certified">
                                <option value="Yes" {{ $item->certified == 'Yes' ? 'checked' : '' }}>Yes</option>
                                <option value="No" {{ $item->certified == 'No' ? 'checked' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Save</button>
                            <a href="{{ route('stable.coach.index') }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back</a>
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
@push('page-scripts')
<script>
    $('#datePicker').datetimepicker({
        format: 'ddd, DD MMM YYYY',
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom'
        },
        minDate: new Date()
    });
    Dropzone.autoDiscover = false;
    // Dropzone.options.createform = false;	
    let token = $('meta[name="csrf-token"]').attr('content');
    var dz = $("div#dropzoneDragArea").dropzone({
                paramName: "photo",
                url: "{{ route('stable.coach.store_img') }}",                
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
                        if(myDropzone.files == ''){
                            location.href = "{{ route('stable.coach.index') }}";
                        }
                        $.ajax({
                            type: 'POST',
                            url: URL,
                            data: formData,
                            success: function(result){
                                if(result.status == "success"){
                                    // fetch the useid 
                                    var coachid = result.coachid;
                                    $("#coachid").val(coachid); // inseting coachid into hidden input field
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
                        //fetch the user id from hidden input field and send that coachid with our image
                        let coachid = document.getElementById('coachid').value;
                        formData.append('coachid', coachid);
                    });
                    
                    this.on("success", function (file, response) {
                        location.href = "{{ route('stable.coach.index') }}";
                    });
                }
            });
</script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\CoachStore') !!}
@endpush