@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-dashboard') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Edit Stable Profile</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Edit your stable profile</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" id="stable-form" action="{{ route('stable.update') }}" enctype="multipart/form-data" method="POST">
                @method('PUT')
                @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Logo</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="form-group">
                                <div class="dropzone dropzone-default dropzone-primary dz-clickable" id="dropzoneDragArea"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Stable Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="name" value="{{ $stable->name }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Province</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" id="province" name="province" onchange="ajaxChained('#province','#city','city')">
                                <option value="">Select province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" @if($province->id == $stable->province_id) selected @endif>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">City</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" id="city" name="city" onchange="ajaxChained('#city','#district','district')">
                                <option value="">Select city</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if($city->id == $stable->city_id) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">District</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" id="district" name="district" onchange="ajaxChained('#district','#village','village')">
                                <option value="">Select district</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" @if($district->id == $stable->district_id) selected @endif>{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Village</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control form-control-lg form-control-solid" id="village" name="village">
                                <option value="">Select village</option>
                                @foreach ($villages as $village)
                                    <option value="{{ $village->id }}" @if($village->id == $stable->village_id) selected @endif>{{ $village->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Stable Address</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <textarea name="address" rows="5" class="form-control form-control-lg form-control-solid">{{ $stable->address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="contact_phone_name" placeholder="Phone Name" value="{{ $stable->contact_person }}" />
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
                                <input type="number" min="0" name="contact_phone_number" class="form-control form-control-lg form-control-solid" placeholder="Phone Number" value="{{ $stable->contact_number }}" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Owner</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="owner" placeholder="Owner Name" value="{{ $stable->owner }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Manager</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="manager" placeholder="Manager Name" value="{{ $stable->manager }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Capacity of Stable</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="number" min="0" name="capacity_of_stable" placeholder="Capacity of Stable" value="{{ $stable->capacity_of_stable }}"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Capacity of Arena</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="number" min="0" name="capacity_of_arena" placeholder="Capacity of Arena" value="{{ $stable->capacity_of_arena }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Number of Coach</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="number" min="0" name="number_of_coach" placeholder="Number of Coach" value="{{ $stable->number_of_coach }}"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Facilities</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <textarea name="facilities" rows="5" class="form-control form-control-lg form-control-solid">{{ $stable->facilities }}</textarea>
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
    $('#province, #city, #district, #village').select2({
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

Dropzone.autoDiscover = false;

let token = $('meta[name="csrf-token"]').attr('content');
const stableForm = $('form#stable-form');
const url = "{{ route('stable.edit.media') }}";

var dz = $("#dropzoneDragArea").dropzone({
    // The configuration we've talked about above
    maxFiles: 1,
    maxFilesize: 2, // MB
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    url: url,
    headers: {
        'X-CSRF-TOKEN': token
    },
    params: {
        size: 2, // for server validator
        path: 'stable/logo'
    },
    success: function (file, response) {
        stableForm.find('input[name="logo"]').remove();
        stableForm.append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
        var name = file.name; 

        var json = JSON.parse(file.xhr.responseText);

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                name  : json.name,
                action: 'delete',
                _token: token
            },
            success: function(response){
                console.log('success delete ' + response.name);
            }
        });

        file.previewElement.remove();

        if (file.status !== 'error') {
            stableForm.find('input[name="logo"]').remove();
            this.options.maxFiles = this.options.maxFiles
        }
    },
    init: function () {},
    error: function (file, response) {
        let message;

        if ($.type(response) === 'string') {
            message = response //dropzone sends it's own error messages in string
        } else {
            message = response.errors.file
        }
        file.previewElement.classList.add('dz-error');
        let _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]');
        let _results = [];
        for (let _i = 0, _len = _ref.length; _i < _len; _i++) {
            let node = _ref[_i];
            _results.push(node.textContent = message)
        }

        return _results
    }

});
</script>
@endpush