@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('owner-horse-sex-create') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Add Horse</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Add your new horse</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" method="post" name="createform" id="createform" action="{{ route('stable.horse.store') }}" enctype="multipart/form-data">
                @csrf
                <!--begin::Body-->
                <input type="hidden" class="horseid" name="horseid" id="horseid" value="">
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
                        <label class="col-xl-3 col-lg-3 col-form-label">Horse Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Horse Owner</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="owner" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Horse Sex</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" name="horse_sex_id">                                
                                @forelse ($sexes as $sex)
                                    <option value="{{ $sex->id }}">{{ $sex->name }}</option>                                
                                @empty
                                    <option>Data Not Found</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Horse Breed</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" name="horse_breed_id">
                                @forelse ($breeds as $breed)
                                    <option value="{{ $breed->id }}">{{ $breed->name }}</option>                                
                                @empty
                                    <option>Data Not Found</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Birth Date</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <input 
                                type="text" 
                                name="birth_date" 
                                id="datePicker"                                
                                readonly="readonly" 
                                autocomplete="off"
                                placeholder="Select Date"
                                data-target="#datePicker"
                                data-toggle="datetimepicker"
                                class="form-control form-control-lg form-control-solid datetimepicker-input" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-calendar-check-o icon-lg"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Passport Number</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="number" min="0" name="passport_number" class="form-control form-control-lg form-control-solid" autocomplete="off"/>
                        </div>
                    </div>                                        
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Pedigree Male</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="pedigree_male" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Pedigree Female</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="pedigree_female" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Save</button>
                            <a href="{{ route('stable.horse.index') }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back</a>
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

        $('#datePicker').datetimepicker({
            format: 'ddd, DD MMM YYYY',
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom'
            },
            date: new Date(),
            useCurrent: false
        });

        // $('#birth_date').val("{{ date('D, d M Y', strtotime(Auth::user()->birth_date)) }}");
    });
    Dropzone.autoDiscover = false;
    // Dropzone.options.createform = false;	
    let token = $('meta[name="csrf-token"]').attr('content');
    var dz = $("div#dropzoneDragArea").dropzone({
                paramName: "photo",
                url: "{{ route('stable.horse.store_img') }}",                
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
                                    var horseid = result.horseid;
                                    $("#horseid").val(horseid); // inseting horseid into hidden input field
                                    if(myDropzone.files == ''){
                                        location.href = "{{ route('stable.horse.index') }}";
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Saving data success',
                                            timer: 3000
                                        });
                                    }
                                    //process the queue
                                    myDropzone.processQueue();
                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Saving data error',
                                        timer: 3000
                                    });
                                    console.log("error");
                                }
                            }
                        });
                    });

                    //Gets triggered when we submit the image.
                    this.on('sending', function(file, xhr, formData){
                        //fetch the user id from hidden input field and send that horseid with our image
                        let horseid = document.getElementById('horseid').value;
                        formData.append('horseid', horseid);
                    });
                    
                    this.on("success", function (file, response) {
                        location.href = "{{ route('stable.horse.index') }}";
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Saving data success',
                            timer: 3000
                        });
                    });
                }
    });
</script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\HorseStore') !!}
@endpush