@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('order-history-show') }}
@endsection

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('user._aside')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom">
            
            <!--begin::Header-->
            <div class="card-header py-3 d-flex justify-content-between">
                <div class="card-title align-items-start flex-column mb-0">
                    <h3 class="card-label font-weight-bolder text-dark">Order History Detail</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">This is your order history detail</span>
                </div>
            </div>
            <!--end::Header-->
            <div class="card card-custom gutter-b">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                        <div class="col-md-10">
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                <h1 class="display-4 font-weight-boldest mb-10">ORDER DETAILS</h1>                                   
                                <div class="d-flex flex-column align-items-md-end px-0">
                                    <span class="d-flex flex-column align-items-md-end">
                                        <img src="{{ asset($slots->pivot->qr_code) }}" class="h-200px w-200px" alt="">                                        
                                    </span>
                                </div>
                            </div>
                            <div class="border-bottom w-100"></div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Package</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->name }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Stable</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->name }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Date & Time</span>
                                    <span class="opacity-70">
                                        Date : {{ date('D, M d Y', strtotime($slots->date)) }}
                                    </span>
                                    <span class="opacity-70">
                                        Time : {{ date('H:i', strtotime($slots->time_start)) . ' - ' . date('H:i', strtotime($slots->time_end)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">ORDER DATE</span>
                                    <span class="opacity-70">{{ date('D, M d Y', strtotime($data->created_at)) }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">ORDER NO.</span>
                                    <span class="opacity-70">{{ $data->id }}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Stable Address</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->address }},</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->village->name }},</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->district->name }},</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->city->name }},</span>
                                    <span class="opacity-70">{{ $data->booking_detail->package->stable->province->name }}.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold text-muted text-uppercase">PAYMENT BRANCH</th>
                                            <th class="font-weight-bold text-muted text-uppercase">PAYMENT ACCOUNT NUMBER</th>
                                            <th class="font-weight-bold text-muted text-uppercase">PAYMENT STATUS</th>
                                            <th class="font-weight-bold text-muted text-uppercase text-right">TOTAL PAID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-weight-bolder">
                                            <td>{{ $data->bank->branch }}</td>
                                            <td>{{ $data->bank->account_number }}</td>
                                            <td>{{ $data->approval_status }}</td>
                                            <td class="text-primary font-size-h3 font-weight-boldest text-right">Rp. {{number_format($data->price_total, 0,',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                    <!-- end: Invoice-->
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection
@push('page-scripts')
@endpush
