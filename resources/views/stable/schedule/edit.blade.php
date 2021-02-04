@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-schedule-edit') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Edit Schedule</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Edit your schedule</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" method="POST" action="{{ route('stable.schedule.update', $item->id) }}">
                @method('PUT')
                @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-9 col-xl-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Time Start</label>
                                    <input type="text" class="form-control" value="{{ $item->time_start }}" name="time1" id="timePickerGen1">
                                </div>																								
                                <div class="col-md-3">
                                    <label>Time End</label>
                                    <input type="text" class="form-control" value="{{ $item->time_end }}" name="time2" id="timePickerGen2">
                                </div>
                                <div class="col-md-3">
                                    <label>Capacity</label>
                                    <input type="number" class="form-control" value="{{ $item->capacity }}" name="capacity" id="capacity">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 col-xl-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Save</button>
                            <a href="{{ route('stable.schedule.index') }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back</a>
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
    $('#datePicker').datetimepicker({
        format: 'ddd, DD MMM YYYY',
        widgetPositioning: {
            horizontal: 'left',
            vertical: 'bottom'
        },
        useCurrent: false
    });

    $("input[id=timePickerGen1]").each(function () {
        $(this).timepicker(
            {
                minuteStep: 60,
                defaultTime: "7:00",
                showMeridian: !1,
                snapToStep: !0
            }
        );
    });
    
    $("input[id=timePickerGen2]").each(function () {
        $(this).timepicker(
            {
                minuteStep: 60,
                defaultTime: "8:00",
                showMeridian: !1,
                snapToStep: !0
            }
        );
    });
</script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\SlotStore') !!}
@endpush