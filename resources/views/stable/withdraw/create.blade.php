@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-coach-edit') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Withdrawal</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Make a Withdrawal</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" method="POST" action="{{ route('stable.withdraw.store') }}">
                @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Current Balance</label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="py-3 font-weight-bold">Rp. 90.000</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Selected Payment Method</label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="py-3 font-weight-bold">Bank Transfer</h5>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Amount</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" name="amount" />
                            <span>Minimum withdraw amount is Rp 200.000</span>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Submit Request</button>
                            <a href="{{ route('stable.withdraw.index') }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back</a>
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
