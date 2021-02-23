@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('stable-dashboard') }}
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
                    <h3 class="card-label font-weight-bolder text-dark">Dashboard</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Dashboard of stable</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4">
                        <!--begin::Stats Widget 18-->
                        <a href="#" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>

                                <span class="text-white font-size-h2 font-weight-bold">
                                    Horses
                                </span>
                                <div class="text-inverse-dark font-weight-bolder font-size-h5 mb-2 mt-5">Total: {{ $stable->horses_count }}</div>
                                <div class="font-weight-bold text-inverse-dark font-size-sm">Capacity of Stables: {{ $stable->capacity_of_stable }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 18-->
                    </div>

                    <div class="col-xl-4">
                        <!--begin::Stats Widget 18-->
                        <a href="#" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>

                                <span class="text-white font-size-h2 font-weight-bold">
                                    Coaches
                                </span>
                                <div class="text-inverse-dark font-weight-bolder font-size-h5 mb-2 mt-5">2</div>
                                <div class="font-weight-bold text-inverse-dark font-size-sm">Number of Coaches: {{ $stable->number_of_coach }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 18-->
                    </div>

                    <div class="col-xl-4">
                        <!--begin::Stats Widget 18-->
                        <a href="#" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>

                                <span class="text-white font-size-h2 font-weight-bold">
                                    Packages
                                </span>
                                <div class="text-inverse-dark font-weight-bolder font-size-h5 mb-2 mt-5">5</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 18-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        <!--begin::Stats Widget 18-->
                        <a href="#" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>

                                <span class="text-white font-size-h2 font-weight-bold">
                                    Earnings
                                </span>
                                <div class="text-inverse-dark font-weight-bolder font-size-h5 mb-2 mt-5">Rp. 90.000</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 18-->
                    </div>

                    <div class="col-xl-4">
                        <!--begin::Stats Widget 18-->
                        <a href="#" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>

                                <span class="text-white font-size-h2 font-weight-bold">
                                    Bookings
                                </span>
                                <div class="text-inverse-dark font-weight-bolder font-size-h5 mb-2 mt-5">Rp. 90.000</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 18-->
                    </div>

                    <div class="col-xl-4">
                        <!--begin::Stats Widget 18-->
                        <a href="#" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                                <span class="svg-icon svg-icon-2x svg-icon-white">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>

                                <span class="text-white font-size-h2 font-weight-bold">
                                    Withdraw
                                </span>
                                <div class="text-inverse-dark font-weight-bolder font-size-h5 mb-2 mt-5">Rp. 90.000</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 18-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <!--begin::Tiles Widget 8-->
                        <div class="">
                            <!--begin::Header-->
                            <div class="">
                                <div class="card-title">
                                    <div class="card-label">
                                        <div class="font-weight-bolder">Weekly Sales Stats</div>
                                        <div class="font-size-sm text-muted mt-2">890,344 Sales</div>
                                    </div>
                                </div>
                                
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="">
                                <!--begin::Items-->
                                <div class="">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center justify-content-between mb-10">
                                        <div class="d-flex align-items-center mr-2">
                                            <div class="symbol symbol-40 symbol-light-primary mr-3 flex-shrink-0">
                                                <div class="symbol-label">
                                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                                                <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Top Horses</a>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Ricky Hunt, Sandra Trepp</div>
                                            </div>
                                        </div>
                                        <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">+90$</div>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center justify-content-between mb-10">
                                        <div class="d-flex align-items-center mr-2">
                                            <div class="symbol symbol-40 symbol-light-warning mr-3 flex-shrink-0">
                                                <div class="symbol-label">
                                                    <span class="svg-icon svg-icon-lg svg-icon-warning">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Devices/Mic.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M12.9975507,17.929461 C12.9991745,17.9527631 13,17.9762852 13,18 L13,21 C13,21.5522847 12.5522847,22 12,22 C11.4477153,22 11,21.5522847 11,21 L11,18 C11,17.9762852 11.0008255,17.9527631 11.0024493,17.929461 C7.60896116,17.4452857 5,14.5273206 5,11 L7,11 C7,13.7614237 9.23857625,16 12,16 C14.7614237,16 17,13.7614237 17,11 L19,11 C19,14.5273206 16.3910388,17.4452857 12.9975507,17.929461 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) rotate(-360.000000) translate(-12.000000, -8.000000)" x="9" y="2" width="6" height="12" rx="3"></rect>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Top Package Sales</a>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">PitStop Emails</div>
                                            </div>
                                        </div>
                                        <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">+4500$</div>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center justify-content-between mb-10">
                                        <div class="d-flex align-items-center mr-2">
                                            <div class="symbol symbol-40 symbol-light-success mr-3 flex-shrink-0">
                                                <div class="symbol-label">
                                                    <span class="svg-icon svg-icon-lg svg-icon-success">
                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"></path>
                                                                <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Top Coaches</a>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Pitstop Email Marketing</div>
                                            </div>
                                        </div>
                                        <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">+75$</div>
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Items-->
                                <!--begin::Chart-->
                                <div id="kt_tiles_widget_8_chart" class="card-rounded-bottom" data-color="danger" style="height: 150px; min-height: 150px;"><div id="apexcharts9fc4fkqt" class="apexcharts-canvas apexcharts9fc4fkqt apexcharts-theme-light" style="width: 775px; height: 150px;"><svg id="SvgjsSvg1321" width="775" height="150" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1323" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1322"><clipPath id="gridRectMask9fc4fkqt"><rect id="SvgjsRect1326" width="782" height="153" x="-3.5" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMask9fc4fkqt"><rect id="SvgjsRect1327" width="779" height="154" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1334" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1335" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1343" class="apexcharts-grid"><g id="SvgjsG1344" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1346" x1="0" y1="0" x2="775" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1347" x1="0" y1="15" x2="775" y2="15" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1348" x1="0" y1="30" x2="775" y2="30" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1349" x1="0" y1="45" x2="775" y2="45" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1350" x1="0" y1="60" x2="775" y2="60" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1351" x1="0" y1="75" x2="775" y2="75" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1352" x1="0" y1="90" x2="775" y2="90" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1353" x1="0" y1="105" x2="775" y2="105" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1354" x1="0" y1="120" x2="775" y2="120" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1355" x1="0" y1="135" x2="775" y2="135" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1356" x1="0" y1="150" x2="775" y2="150" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1345" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1358" x1="0" y1="150" x2="775" y2="150" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1357" x1="0" y1="1" x2="0" y2="150" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1328" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1329" class="apexcharts-series" seriesName="NetxProfit" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1332" d="M 0 150L 0 83.33333333333333C 54.25 83.33333333333333 100.75 83.33333333333333 155 83.33333333333333C 209.25 83.33333333333333 255.75 50 310 50C 364.25 50 410.75 100 465 100C 519.25 100 565.75 16.666666666666657 620 16.666666666666657C 674.25 16.666666666666657 720.75 50 775 50C 775 50 775 50 775 150M 775 50z" fill="rgba(255,226,229,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask9fc4fkqt)" pathTo="M 0 150L 0 83.33333333333333C 54.25 83.33333333333333 100.75 83.33333333333333 155 83.33333333333333C 209.25 83.33333333333333 255.75 50 310 50C 364.25 50 410.75 100 465 100C 519.25 100 565.75 16.666666666666657 620 16.666666666666657C 674.25 16.666666666666657 720.75 50 775 50C 775 50 775 50 775 150M 775 50z" pathFrom="M -1 150L -1 150L 155 150L 310 150L 465 150L 620 150L 775 150"></path><path id="SvgjsPath1333" d="M 0 83.33333333333333C 54.25 83.33333333333333 100.75 83.33333333333333 155 83.33333333333333C 209.25 83.33333333333333 255.75 50 310 50C 364.25 50 410.75 100 465 100C 519.25 100 565.75 16.666666666666657 620 16.666666666666657C 674.25 16.666666666666657 720.75 50 775 50" fill="none" fill-opacity="1" stroke="#f64e60" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask9fc4fkqt)" pathTo="M 0 83.33333333333333C 54.25 83.33333333333333 100.75 83.33333333333333 155 83.33333333333333C 209.25 83.33333333333333 255.75 50 310 50C 364.25 50 410.75 100 465 100C 519.25 100 565.75 16.666666666666657 620 16.666666666666657C 674.25 16.666666666666657 720.75 50 775 50" pathFrom="M -1 150L -1 150L 155 150L 310 150L 465 150L 620 150L 775 150"></path><g id="SvgjsG1330" class="apexcharts-series-markers-wrap" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1364" r="0" cx="0" cy="0" class="apexcharts-marker w4dl4fcbh no-pointer-events" stroke="#f64e60" fill="#ffe2e5" fill-opacity="1" stroke-width="3" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1331" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1359" x1="0" y1="0" x2="775" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1360" x1="0" y1="0" x2="775" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1361" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1362" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1363" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1342" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1324" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 75px;"></div><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Poppins; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 226, 229);"></span><div class="apexcharts-tooltip-text" style="font-family: Poppins; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"><div class="apexcharts-xaxistooltip-text" style="font-family: Poppins; font-size: 12px;"></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                                <!--end::Chart-->
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 1035px; height: 474px;"></div></div><div class="contract-trigger"></div></div><div class="resize-triggers"><div class="expand-trigger"><div style="width: 806px; height: 491px;"></div></div><div class="contract-trigger"></div></div></div>
                            <!--end::Body-->
                        </div>
                        <!--end::Tiles Widget 8-->
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection
