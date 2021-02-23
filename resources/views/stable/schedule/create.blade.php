@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-schedule-create') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Create Schedule</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Create your new schedule</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form repeater" method="POST" action="{{ route('stable.schedule.store') }}">
                @csrf
                <!--begin::Body-->
                <div class="card-body">
                    @if ($stableSlotSettings->isNotEmpty())
                        <div class="alert alert-custom alert-light fade show mb-10" role="alert">
                            <div class="alert-text font-weight-bold">
                                We close stable at every
                                @php
                                    $result = '';
                                    foreach($stableSlotSettings as $stableSlotSetting) {
                                        if ($stableSlotSetting->closed_day == 1) {
                                            $result .= 'Monday'.', ';
                                        }
                                        if ($stableSlotSetting->closed_day == 2) {
                                            $result .= 'Tuesday'.', ';
                                        }
                                        if ($stableSlotSetting->closed_day == 3) {
                                            $result .= 'Wednesday'.', ';
                                        }
                                        if ($stableSlotSetting->closed_day == 4) {
                                            $result .= 'Thursday'.', ';
                                        }
                                        if ($stableSlotSetting->closed_day == 5) {
                                            $result .= 'Friday'.', ';
                                        }
                                        if ($stableSlotSetting->closed_day == 6) {
                                            $result .= 'Saturday'.', ';
                                        }
                                        if ($stableSlotSetting->closed_day == 7) {
                                            $result .= 'Sunday'.', ';
                                        }
                                    }
                                    $result = rtrim($result,', ');
                                @endphp
                                {{ $result }}
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
                        <div class="col-md-9">
                            <label>Date</label>
                            <div class="input-daterange input-group date_range" id="date_range">
                                <input type="text" class="form-control" name="start" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-ellipsis-h"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="end" autocomplete="off">
                            </div>
                        </div>	
                    </div>
                        <!--
                            The value given to the data-repeater-list attribute will be used as the
                            base of rewritten name attributes.  In this example, the first
                            data-repeater-item's name attribute would become group-a[0][text-input],
                            and the second data-repeater-item would become group-a[1][text-input]
                        -->
                    <div data-repeater-list="group-a">
                        <div data-repeater-item class="form-group row">											
                            <div class="col-md-3">
                                <label>Time Start</label>
                                <input type="text" class="form-control" name="time1" id="timePickerGen1">
                            </div>																								
                            <div class="col-md-3">
                                <label>Time End</label>
                                <input type="text" class="form-control" name="time2" id="timePickerGen2">
                            </div>
                            <div class="col-md-3">
                                <label>Capacity</label>
                                <input type="number" class="form-control" name="capacity" id="capacity">
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button data-repeater-delete type="button" class="btn font-weight-bolder btn-light-danger">
                                    <i class="la la-trash-o"></i> Delete</a>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9">
                            <button data-repeater-create type="button" class="btn font-weight-bolder btn-secondary mt-repeater-add">
                                <i class="la la-plus"></i> Add</a>
                            </button>
                        </div>	
                    </div>

                    
                    <div class="row mt-5">
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
    $('#date_range').datepicker({
        todayHighlight: true,
        orientation: "bottom left",
        autoclose: true,
        // language : 'id',
        format   : 'D, M d yyyy',
        startDate: new Date(),
    });

    // Create form repeater to generate a lot of schedule
    $('.repeater').repeater();
     // For time in generate schedule
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
    $('.mt-repeater-add').click(function(){
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

    })
</script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\SlotStore') !!}
@endpush