@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-assign') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Assign Horse And Coach</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Package : {{ $booking_detail->package->name }}</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <!--begin::Top-->
                                <div class="d-flex">
                                    <!--begin::Pic-->
                                    <div class="flex-shrink-0 mr-7">
                                        <div class="symbol symbol-50 symbol-lg-120">
                                            <img alt="Pic" src="{{ asset($booking_detail->package->photo) }}">
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin: Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Title-->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                            <!--begin::User-->
                                            <div class="mr-3">
                                                <!--begin::Name-->
                                                <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $booking_detail->package->name }} 
                                                <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                                                <!--end::Name-->
                                            </div>
                                            <!--begin::User-->
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Content-->
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <!--begin::Description-->
                                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">{{ $booking_detail->package->description }}</div>
                                            <!--end::Description-->
                                        </div>

                                        <form action="" class="mt-10" method="post">
                                            @method('PUT')
                                            @csrf
                                            <span class="font-weight-bolder font-size-h5">
                                                Assign
                                            </span>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Horse Name</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control selectHorse2" placeholder="Select Stable" name="horse_id" id="horseId">
                                                        <option value="">Select Horse</option>
                                                        @foreach ($stable->horses as $horse)
                                                            <option value="{{ $horse->id }}" @if($horse->id == request()->input('horse_id')) selected @endif>{{ $horse->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>                                                
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Coach Name</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control selectCoach2" placeholder="Select Stable" name="coach_id" id="coachId">
                                                        <option value="">Select Coach</option>
                                                        @foreach ($stable->coaches as $coach)
                                                            <option value="{{ $coach->id }}" @if($coach->id == request()->input('coach_id')) selected @endif>{{ $coach->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase">Submit</button>
                                        </form>
                                        
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Top-->
                                <!--begin::Separator-->
                                <div class="separator separator-solid my-7"></div>
                                <!--end::Separator-->
                                <!--begin::Bottom-->
                                <div class="d-flex align-items-center flex-wrap">
                                    <!--begin: Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                        <span class="mr-4">
                                            <i class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">Price</span>
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-dark-50 font-weight-bold">Rp. </span>{{number_format($booking_detail->booking->price_total, 0, ',', '.')}}</span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <!--begin: Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                        <span class="mr-4">
                                            <i class="flaticon-confetti icon-2x text-muted font-weight-bold"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">Date</span>
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-dark-50 font-weight-bold"></span>{{ \Carbon\Carbon::parse($slot->date)->format('D, d M Y') }}</span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <!--begin: Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                        <span class="mr-4">
                                            <i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">Time</span>
                                            <span class="font-weight-bolder font-size-h5">
                                            <span class="text-dark-50 font-weight-bold"></span>{{ \Carbon\Carbon::parse($slot->time_start)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->time_end)->format('H:i') }}</span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <!--begin: Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                        <span class="mr-4">
                                            <i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
                                        </span>
                                        <div class="d-flex flex-column flex-lg-fill">
                                            <span class="text-dark-75 font-weight-bolder font-size-sm">Username</span>
                                            <a href="#" class="text-primary font-weight-bolder">{{ $user->name }}</a>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <!--begin: Item-->                                    
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                        <span class="mr-4">
                                            <i class="flaticon-chat-1 icon-2x text-muted font-weight-bold"></i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark-75 font-weight-bolder font-size-sm">User Phone</span>
                                            <a href="#" class="text-primary font-weight-bolder">{{ $user->phone }}</a>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                </div>
                                <!--end::Bottom-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection
@push('page-scripts')
<script type="text/javascript">
    $(function() {
        $('.selectHorse2').select2({
            placeholder: "Select Horse",
            width:"100%",
        });
        $('.selectCoach2').select2({
            placeholder: "Select Coach",
            width:"100%",
        });
    });
</script>
@endpush
