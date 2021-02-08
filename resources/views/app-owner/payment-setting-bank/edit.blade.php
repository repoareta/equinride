@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('owner-bank-edit') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Edit Bank</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Edit your bank</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" method="post" name="createform" id="createform" action="{{ route('app_owner.bank.update', $item->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <!--begin::Body-->
                <input type="hidden" class="bankid" name="bankid" id="bankid" value="">
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
                        <label class="col-xl-3 col-lg-3 col-form-label">Bank Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="account_name" value="{{ $item->account_name }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Bank Number</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="number" min="0" name="account_number" value="{{ $item->account_number }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Branch</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="branch" value="{{ $item->branch }}"/>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Save</button>
                            <a href="{{ route('app_owner.bank.index') }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back</a>
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
                url: "{{ route('app_owner.bank.store_img') }}",                
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
                                    var bankid = result.bankid;
                                    $("#bankid").val(bankid); // inseting bankid into hidden input field
                                    if(myDropzone.files == ''){
                                        location.href = "{{ route('app_owner.bank.index') }}";
                                        Swal.fire({
                                            icon: 'Success',
                                            title: 'success',
                                            text: 'Updating data success',
                                            timer: 3000
                                        });
                                    }
                                    //process the queue
                                    myDropzone.processQueue();
                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Updating data error',
                                        timer: 3000
                                    });
                                    console.log("error");
                                }
                            }
                        });
                    });

                    //Gets triggered when we submit the image.
                    this.on('sending', function(file, xhr, formData){
                        //fetch the user id from hidden input field and send that bankid with our image
                        let bankid = document.getElementById('bankid').value;
                        formData.append('bankid', bankid);
                    });
                    
                    this.on("success", function (file, response) {
                        location.href = "{{ route('app_owner.bank.index') }}";
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Updating data success',
                            timer: 3000
                        });
                    });
                }
            });
</script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\BankPaymentStore') !!}
@endpush