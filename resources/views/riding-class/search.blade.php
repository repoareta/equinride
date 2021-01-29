@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('riding-class-search') }}
@endsection

@section('content')
<div class="row" data-sticky-container="">
    <div class="col-lg-4 col-xl-3">
        <div class="card card-custom sticky mb-10" data-sticky="true" data-margin-top="120px" data-sticky-for="1023" data-sticky-class="sticky">
            <div class="card-header p-5">
                <h3 class="card-title">
                    Search
                </h3>
            </div>
            <!--begin::Form-->
            <form action="{{ route('riding_class.search') }}" method="get">
                <div class="card-body p-5">
                    <div class="form-group">
                        <select class="form-control select2" placeholder="Select Stable" name="stable_name" id="stable_name">
                            <option value="">Selet Stable</option>
                            @foreach ($stables as $stable)
                                <option value="{{ $stable->name }}" @if($stable->name == request()->input('stable_name')) selected @endif>{{ $stable->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="input-group date">
                            <input 
                            type="text" 
                            class="form-control datetimepicker-input" 
                            id="kt_datepicker_2" 
                            readonly="readonly" 
                            autocomplete="off" 
                            name="date_start" 
                            placeholder="Select Date" 
                            value="{{ request()->input('date_start') }}" 
                            data-target="#kt_datepicker_2"
                            data-toggle="datetimepicker">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group timepicker">
                            <input 
                            type="text" 
                            class="form-control datetimepicker-input" 
                            id="datetimepicker3" 
                            readonly="readonly" 
                            autocomplete="off" 
                            name="time_start" 
                            placeholder="Select Time" 
                            value="{{ request()->input('time_start') }}"
                            data-toggle="datetimepicker" 
                            data-target="#datetimepicker3">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-clock-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-5">
                    <button type="submit" class="btn btn-secondary font-weight-bolder mb-5 float-right">Submit</button>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
    <div class="col-lg-8 col-xl-9">
        @forelse ($packages as $package)
            <div class="card card-custom gutter-b">
                <div class="card-body p-5">
                    <div class="d-flex">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-50 symbol-lg-150">
                                @if ($package->photo)
                                    <img alt="Pic" src="{{ asset('assets/media//users/300_7.jpg') }}"> 
                                @else
                                    <img alt="Pic" src="{{ asset('assets/media//users/300_1.jpg') }}">
                                @endif
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin: Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <!--begin::User-->
                                <div class="mr-3">
                                    <div class="d-flex align-items-center mr-3">
                                        <!--begin::Name-->
                                        <span class="d-flex align-items-center text-dark text-hover-primary font-size-h2 font-weight-bold mr-3">
                                            {{ $package->name }}
                                        </span>
                                        <!--end::Name-->
                                    </div>
                                    <!--begin::Contacts-->
                                    <div class="d-flex flex-wrap my-2">
                                        <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo4/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect opacity="0.300000012" x="0" y="0" width="24" height="24"/>
                                                    <polygon fill="#000000" fill-rule="nonzero" opacity="0.3" points="7 4.89473684 7 21 5 21 5 3 11 3 11 4.89473684"/>
                                                    <path d="M10.1782982,2.24743315 L18.1782982,3.6970464 C18.6540619,3.78325557 19,4.19751166 19,4.68102291 L19,19.3190064 C19,19.8025177 18.6540619,20.2167738 18.1782982,20.3029829 L10.1782982,21.7525962 C9.63486295,21.8510675 9.11449486,21.4903531 9.0160235,20.9469179 C9.00536265,20.8880837 9,20.8284119 9,20.7686197 L9,3.23140966 C9,2.67912491 9.44771525,2.23140966 10,2.23140966 C10.0597922,2.23140966 10.119464,2.2367723 10.1782982,2.24743315 Z M11.9166667,12.9060229 C12.6070226,12.9060229 13.1666667,12.2975724 13.1666667,11.5470105 C13.1666667,10.7964487 12.6070226,10.1879981 11.9166667,10.1879981 C11.2263107,10.1879981 10.6666667,10.7964487 10.6666667,11.5470105 C10.6666667,12.2975724 11.2263107,12.9060229 11.9166667,12.9060229 Z" fill="#000000"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>{{ $package->stable->name }}</a>
                                        
                                        <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo4/dist/assets/media/svg/icons/Map/Marker2.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>{{ $package->stable->city->name }}</a>
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                                <!--begin::User-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                                <!--begin::Description-->
                                <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                                    {{ $package->description }}
                                </div>
                                <!--end::Description-->
                                <!--begin::Progress-->
                                <div class="mb-0">
                                    <h4 class="text-dark font-weight-bolder mr-2">
                                        Rp. {{ number_format($package->price, 0, ",", ".") }}
                                    </h4>
                                </div>
                                <!--end::Progress-->
                            </div>
                            <!--end::Content-->

                            <!--begin::Content-->
                            <div class="d-flex flex-wrap float-right">
                                <!--begin::Progress-->
                                <div class="mb-1">
                                    <form class="d-inline" method="POST" action="{{ route('package.booking', ['package' => $package->id]) }}">
                                        @csrf
                                        <input type="hidden" name="date_start" value="{{ request()->input('date_start') }}">
                                        <input type="hidden" name="time_start" value="{{ request()->input('time_start') }}">
                                        <button type="submit" class="btn btn-sm btn-warning font-weight-bolder mr-2 p-3 px-10">Book Now</button>
                                    </form>
                                </div>
                                <!--end::Progress-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
        @empty
            No Packages Found
        @endforelse

        <div class="d-flex align-items-center flex-wrap p5-10 justify-content-center">
            <div class="d-flex flex-wrap py-2 mr-3">
                {{ $packages->appends([
                    'stable_name' => request()->input('stable_name'),
                    'date_start' => request()->input('date_start'),
                    'time_start' => request()->input('time_start')
                    ])->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@endsection

@include('riding-class.scripts')