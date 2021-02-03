@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-dashboard') }}
@endsection

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    <div class="flex-row-auto offcanvas-mobile w-350px w-xxl-350px" id="kt_profile_aside">
        <!--begin::Profile Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Body-->
            <div class="card-body">
                @include('stable.register-aside')
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
                    <h3 class="card-label font-weight-bolder text-dark">Stable Register</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Store your stable information</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" action="{{ route('stable.register.submit') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Stable Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Province</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" id="province" name="province" onchange="ajaxChained('#province','#city','city')">
                                <option value="">Select province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">City</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" id="city" name="city" disabled onchange="ajaxChained('#city','#district','district')">
                                <option value="">Select city</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">District</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" id="district" name="district" disabled onchange="ajaxChained('#district','#village','village')">
                                <option value="">Select district</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Village</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" id="village" name="village" disabled>
                                <option value="">Select village</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Stable Address</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <textarea name="address" rows="5" class="form-control form-control-lg form-control-solid"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="contact_phone_name" placeholder="Phone Name"/>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone Number</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-phone"></i>
                                    </span>
                                </div>
                                <input type="number" min="0" name="contact_phone_number" class="form-control form-control-lg form-control-solid" placeholder="Phone Number" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Submit</button>
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
        $('#datePicker').datepicker({
        todayHighlight: true,
            orientation: "bottom left",
            autoclose: true,
            // language : 'id',
            format   : 'yyyy-mm-dd'
        });

        $('#province').select2({
            width:"100%"
        });
    });

    function ajaxChained(source, target, slug){
        var pid = $(source + ' option:selected').val(); //$(this).val();

            $.ajax({
                type: 'POST',
                url: '{{ url('/') }}/api/'+ slug +'/'+ pid,
                dataType: 'json',
                data: { 
                    id : pid 
                }
            }).done(function(response){
                //get JSON

                $(target).prop("disabled", true);

                //generate <options from JSON
                var list_html = '';
                list_html += '<option value=""></option>';
                $.each(response.data, function(i, item) {
                    list_html += '<option value='+response.data[i].id+'>'+response.data[i].name+'</option>';
                });
                
                //replace <select2 with new options
                $(target).html(list_html);
                $(target).prop("disabled", false);
                //change placeholder text
                // $(target).select2({placeholder: response.data.length +' results'});
                $(target).select2({placeholder: 'Select ' + slug});
            });
    }
</script>
@endpush