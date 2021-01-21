@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('riding-class') }}
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
                        <div class="input-group">
                            <input type="text" class="form-control" name="stable_name" placeholder="Enter Stable Name" value="{{ request()->input('stable_name') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-search-location"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group date">
                            <input type="text" class="form-control" id="kt_datepicker_2" readonly="readonly" autocomplete="off" name="date_start" placeholder="Select Date" value="{{ request()->input('date_start') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group timepicker">
                            <input class="form-control datetimepicker-input" id="datetimepicker3" data-toggle="datetimepicker" data-target="#datetimepicker3" readonly="readonly" autocomplete="off" name="time_start" placeholder="Select Time" type="text" value="{{ request()->input('time_start') }}">
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
        @for ($i = 0; $i < 10; $i++)
        <div class="card card-custom gutter-b">
            <div class="card-body p-5">
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-150">
                            <img alt="Pic" src="{{ asset('assets/media//users/300_1.jpg') }}">
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
                                    <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">David Smith</a>
                                    <!--end::Name-->
                                    <span class="label label-light-success label-inline font-weight-bolder mr-1">Customer</span>
                                </div>
                                <!--begin::Contacts-->
                                <div class="d-flex flex-wrap my-2">
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo4/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>
                                                <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>david.s@loop.com</a>
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo4/dist/assets/media/svg/icons/General/Lock.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <mask fill="white">
                                                    <use xlink:href="#path-1"></use>
                                                </mask>
                                                <g></g>
                                                <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>PR Manager</a>
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
                                    </span>Melbourne</a>
                                </div>
                                <!--end::Contacts-->
                            </div>
                            <!--begin::User-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">I distinguish three main text objectives could be merely to inform people. 
                            <br>A second could be persuade people. You want people to bay objective.</div>
                            <!--end::Description-->
                            <!--begin::Progress-->
                            <div class="mb-0">
                                <h4 class="text-dark font-weight-bolder mr-2">Rp. 50.000.000</h4>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Content-->

                        <!--begin::Content-->
                        <div class="d-flex flex-wrap float-right">
                            <!--begin::Progress-->
                            <div class="mb-1">
                                <a href="{{ route('package.booking', ['package' => 14]) }}" class="btn btn-sm btn-warning font-weight-bolder mr-2 p-3 px-10">Book Now</a>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>
        @endfor

        <div class="d-flex align-items-center flex-wrap p5-10 justify-content-center">
            <div class="d-flex flex-wrap py-2 mr-3">
                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
        
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">23</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">24</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">25</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">26</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">27</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">28</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
        
                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection
