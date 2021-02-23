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
                    <h3 class="card-label font-weight-bolder text-dark">Schedule Setting</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Configure your schedule setting</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" method="POST" action="{{ route('stable.schedule.setting.store') }}">
                @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-3 col-form-label">We closed the stable at</label>
                        <div class="col-9 col-form-label">
                            <div class="checkbox-list">
                               
                                <label class="checkbox">
                                    <input type="checkbox" name="closed_days[]" value="1"
                                    @if($stableSlotSettings->firstWhere('closed_day', 1)) checked="checked" 
                                    @endif>
                                <span></span>Every Monday</label>
                                
                                <label class="checkbox">
                                    <input type="checkbox" name="closed_days[]" value="2"
                                    @if($stableSlotSettings->firstWhere('closed_day', 2))       checked="checked" 
                                    @endif>
                                <span></span>Every Tuesday</label>

                                <label class="checkbox">
                                    <input type="checkbox" name="closed_days[]" value="3"
                                    @if($stableSlotSettings->firstWhere('closed_day', 3))       checked="checked" 
                                    @endif>
                                <span></span>Every Wednesday</label>

                                <label class="checkbox">
                                    <input type="checkbox" name="closed_days[]" value="4"
                                    @if($stableSlotSettings->firstWhere('closed_day', 4))       checked="checked" 
                                    @endif>
                                <span></span>Every Thursday</label>

                                <label class="checkbox">
                                    <input type="checkbox" name="closed_days[]" value="5"
                                    @if($stableSlotSettings->firstWhere('closed_day', 5))       checked="checked" 
                                    @endif>
                                <span></span>Every Friday</label>

                                <label class="checkbox">
                                    <input type="checkbox" name="closed_days[]" value="6"
                                    @if($stableSlotSettings->firstWhere('closed_day', 6))       checked="checked" 
                                    @endif>
                                <span></span>Every Saturday</label>

                                <label class="checkbox">
                                    <input type="checkbox" name="closed_days[]" value="7"
                                    @if($stableSlotSettings->firstWhere('closed_day', 7))       checked="checked" 
                                    @endif>
                                <span></span>Every Sunday</label>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-xl-3"></label>
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

</script>
@endpush