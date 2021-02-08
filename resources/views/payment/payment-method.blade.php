@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('package-payment-method', $package) }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b">
            <div class="car-body px-5 py-8">
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                @if ($package->photo)
                                <div class="symbol-label" style="background-image:url('{{ asset($package->photo) }}')"></div>
                                @else
                                    <div class="symbol-label" style="background-image:url({{ asset('assets/media/users/300_21.jpg') }})"></div>
                                @endif
                                <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ $package->stable->name }}</a>
                                <div class="text-muted">{{ $package->name }}</div>
                            </div>
                        </div>

                        <h4 class="font-weight-bold mb-5">
                            Select Payment Method
                        </h4>

                        @include('payment.payment-method-menu')
                        
                    </div>
                    <div class="col-8">
                        <div class="tab-content" id="myTabContent5">
                            @include('payment.method.bank-transfer')
                            @include('payment.method.virtual-account')
                            @include('payment.method.ovo')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- next payment start --}}
    @include('payment.payment-booking-detail')
</div>

@endsection