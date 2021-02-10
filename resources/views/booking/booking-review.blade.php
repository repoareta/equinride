@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('package-booking', $package) }}
@endsection

@section('content')
<div class="row" data-sticky-container="">
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b">
            <div class="card-body p-5">
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-150">
                            <img alt="Pic" src="{{ asset($package->photo) }}">
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                            <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-3">{{ $package->name }}</div>
                                    <!--end::Name-->
                                </div>
                            </div>
                            <!--Start::Dashed Line-->
                            <div class="separator separator-dashed separator-border-2 my-3"></div>
                            <!--End::Dashed Line-->
                            <!--begin::User-->
                        <!--end::Title-->

                        <div class="row mr-30">
                            <div class="col-md-4">
                                <h6>Booking Date</h6>
                                <p>{{ \Carbon\Carbon::parse($package->stable->slots->first()->date)->format('D, d M Y') }}</p>
                            </div>
    
                            <div class="col-md-4">
                                <h6>Time Start</h6>
                                <p>{{ \Carbon\Carbon::parse($package->stable->slots->first()->time_start)->format('H:i') }}</p>
                            </div>
    
                            <div class="col-md-4">
                                <h6>Time End</h6>
                                <p>{{ \Carbon\Carbon::parse($package->stable->slots->first()->time_end)->format('H:i') }}</p>
                            </div>

                            <div class="col-md-4">
                                <h6>Guest Name</h6>
                                <p>
                                    {{ ucwords(Auth::user()->name) }}
                                </p>
                            </div>
                        </div>

                        <!--Start::Dashed Line-->
                        <div class="separator separator-dashed separator-border-2 my-3"></div>
                        <!--End::Dashed Line-->

                        <div class="row">
                            <div class="col-12">
                                <h6>Riding Class Details</h6>
                                <div class="row">
                                    <div class="col-md-2 my-3">
                                        Stable
                                    </div>
                                    <div class="col-md-10 my-3">
                                        {{ $package->stable->name }}
                                    </div>
                                    <div class="col-md-2 my-3">
                                        Description
                                    </div>
                                    <div class="col-md-10 my-3 text-justify">
                                        {{ $package->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>

        <div class="card card-custom gutter-b">
            <div class="card-body p-5">
                <div class="d-flex">
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                            <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-3">
                                        Reschedule Policy
                                    </div>
                                    <!--end::Name-->
                                </div>
                            </div>
                            <!--Start::Dashed Line-->
                            <div class="separator separator-dashed separator-border-2 my-3"></div>
                            <!--End::Dashed Line-->
                            
                            <p class="text-justify">
                                Packages can be rescheduled only once as long as the package's validity period has not ended or closed by the stable
                            </p>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>

        <h3>
            Price Details
        </h3>

        <div class="card card-custom gutter-b">
            <div class="card-body p-5">
                <div class="d-flex">
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <div class="d-flex">
                            <div class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-3">
                                {{ $package->stable->name }}
                            </div>
                        </div>

                        <!--Start::Dashed Line-->
                        <div class="separator separator-dashed separator-border-2 my-3"></div>
                        <!--End::Dashed Line-->

                        <div class="d-flex align-items-center flex-wrap justify-content-between mb-3">
                            <div class="font-weight-bolder font-size-h5 text-dark">
                                [{{ $package->attendance }}x] {{ $package->stable->name }}, {{ $package->name }}
                            </div>
                            <div class="text-right mt-3 mt-md-0">
                                <h3 class="font-weight-bolder font-size-h5 text-dark">
                                    Rp. {{ number_format($package->price, 0, ",", ".") }}
                                </h3>
                            </div>
                        </div>

                        <div class="d-flex align-items-center flex-wrap justify-content-between mb-3">
                            <div class="font-weight-bolder font-size-h5 text-success">
                                Taxes and Other Fees
                            </div>
                            <div class="text-right mt-3 mt-md-0">
                                <h3 class="font-weight-bolder font-size-h5 text-success">
                                    Included
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--end::Info-->
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between p-5">
                <h3 class="font-weight-bolder font-size-h5 text-dark">Total:</h3>
                <h3 class="font-weight-bolder font-size-h5 text-dark">Rp. {{ number_format($package->price, 0, ",", ".") }}</h3>
            </div>
        </div>

        <div class="d-flex-1 mb-10 d-none d-lg-flex">
            <div class="flex-grow-1">
                <div class="d-flex align-items-center flex-wrap justify-content-between">
                    <!--begin::Description-->
                    <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                        By clicking this button, you ackowladge than you hav read amd agreed to the 
                        <br>
                        <a href="#">Terms & Conditions</a>
                        and <a href="#">Privacy Policy</a> of Equinride 
                    </div>
                    <!--end::Description-->
                    <!--begin::Progress-->
                    <div class="mb-0">
                        <button class="btn btn-block font-weight-bolder btn-warning px-10 py-5" onclick="event.preventDefault();document.getElementById('booking-review-form').submit();">
                            Continue to Payment
                        </button>
                    </div>
                    <!--end::Progress-->
                </div>
            </div>
        </div>
    </div>

    {{-- next payment start --}}
    <div class="col-lg-4 col-xl-3">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <p>
                    By clicking this button, you acknowladge that you have read and agreed to the <a href="#">Terms & Conditions</a>
                    and <a href="#">Privacy Policy</a> of Equinride 
                </p>
                <button class="btn btn-block font-weight-bolder btn-warning" onclick="event.preventDefault();document.getElementById('booking-review-form').submit();">Continue to Payment</button>

                <form id="booking-review-form" action="{{ route('package.payment_method', ['package' => $package->id]) }}" method="POST" class="d-none">
                    @csrf
                    <input type="hidden" name="date_start" value="{{ \Carbon\Carbon::parse($package->stable->slots->first()->date)->format('D, d M Y') }}">
                    <input type="hidden" name="time_start" value="{{ \Carbon\Carbon::parse($package->stable->slots->first()->time_start)->format('H:i') }}">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
