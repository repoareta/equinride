@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('package-payment-confirmation', $package) }}
@endsection

@section('content')
<div class="row" data-sticky-container="">

    <div class="col-lg-12 col-xl-12">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="font-size-h4 font-weight-bold">
                    Thank you, your order is now being processed.
                </div>
                <p class="mb-0">
                    Our confirmation will be been sent to your email immediately.
                </p>
                <a href="#" class="btn btn-primary btn font-weight-bolderpy-5">Purchase History</a>
            </div>
        </div>
    </div>
    
</div>

@endsection