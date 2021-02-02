@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('package-payment-confirmation', $package) }}
@endsection

@section('content')
<div class="row" data-sticky-container="">
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b">
            <div class="card-body p-5">
                <div class="alert alert-custom alert-notice alert-light-success fade show p-2" role="alert">
                    <div class="alert-icon"><i class="flaticon2-information"></i></div>
                    <div class="alert-text">Payment instructions have been sent to your email</div>
                    <div class="alert-close mr-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>

                @include('payment.confirmation.bank-transfer')
            </div>
        </div>

        <div class="mb-5">
            <div class="row">
                <div class="col-md-7">
                    By clicking this button, you ackowladge than you hav read amd agreed to the 
                    <a href="#">Terms &amp; Conditions</a> and <a href="#">Privacy Policy</a> of Equinride
                </div>
                <div class="col-md-5 mt-3 mt-md-0">
                    <button class="btn btn-block font-weight-bolder btn-warning py-5" onclick="event.preventDefault();document.getElementById('payment-confirmation-form').submit();">
                        Submit Payment
                    </button>
                </div>
            </div>
        </div>

    </div>

    {{-- next payment start --}}
    @include('payment.payment-booking-detail')
</div>

@endsection