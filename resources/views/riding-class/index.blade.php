@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('riding-class') }}
@endsection
@push('page-styles')
<style>
    .star-rating {
        /* line-height:32px; */
        font-size:1em;
    }

    .star-rating .fa-star{
        color: orange;
    }
</style>
@endpush
@section('content')
<style>
    body {
        overflow-x: hidden;
    }

    .select2-container--default.select2-container--open .select2-selection--single {
        border: 0 !important;
    }

    .select2-container--default .select2-selection--single {
        border: 0 !important;
    }
</style>

<div class="row" style="margin-left:-25px; margin-right:-25px">
    <div class="col-md-12 p-0">
        <div class="m-0">
            <div class="subheader py-5 py-lg-10 gutter-b subheader-transparent" style="background-color: #353a52; background-position: right bottom; background-size: auto 100%; background-repeat: no-repeat; background-image: url(assets/media/svg/patterns/taieri.svg)">
                <div class="container-fluid d-flex flex-column">
                    <!--begin::Title-->
                    <div class="d-flex align-items-sm-end flex-column flex-sm-row mb-5">
                        <h2 class="d-flex align-items-center text-white mr-5 mb-0">Search</h2>
                        <span class="text-white opacity-60 font-weight-bold">Find deals on stables, riding class, and much more...</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::Search Bar-->
                    <div class="d-flex align-items-md-center mb-2 flex-column flex-md-row">
                        <div class="bg-white rounded p-4 d-flex flex-grow-1 flex-sm-grow-0">
                            <!--begin::Form-->
                            <form class="form d-flex align-items-md-center flex-sm-row flex-column flex-grow-1 flex-sm-grow-0" action="{{ route('riding_class.search') }}" method="get">
                                <!--begin::Input-->
                                <div class="d-flex align-items-center py-3 py-sm-0 px-sm-3">
                                    <span class="svg-icon svg-icon-lg">
                                        <i class="la la-search-location icon-lg"></i>
                                    </span>
                                    <select class="form-control select2 border-0 font-weight-bold pl-2" name="stable_name" id="stable_name">
                                        <option value="">Select Stable</option>
                                        @foreach ($stables as $stable)
                                            <option value="{{ $stable->name }}">{{ ucwords($stable->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--end::Input-->

                                <!--begin::Input-->
                                <span class="bullet bullet-ver h-25px d-none d-sm-flex mr-2"></span>

                                <div class="d-flex align-items-center py-3 py-sm-0 px-sm-3">
                                    <span class="svg-icon svg-icon-lg">
                                        <i class="la la-calendar-check-o icon-lg"></i>
                                    </span>
                                    <input 
                                    type="text" 
                                    class="form-control border-0 font-weight-bold pl-2 datetimepicker-input" id="date_start" 
                                    readonly="readonly" 
                                    placeholder="Select Date"
                                    readonly="readonly" 
                                    autocomplete="off" 
                                    name="date_start"
                                    data-target="#date_start"
                                    data-toggle="datetimepicker">
                                </div>
                                <!--end::Input-->

                                <!--begin::Input-->
                                <span class="bullet bullet-ver h-25px d-none d-sm-flex mr-2"></span>

                                <div class="d-flex align-items-center py-3 py-sm-0 px-sm-3">
                                    <span class="svg-icon svg-icon-lg">
                                        <i class="la la-clock-o icon-lg"></i>
                                    </span>
                                    <input type="text" class="form-control border-0 font-weight-bold pl-2 datetimepicker-input" id="datetimepicker3" data-toggle="datetimepicker" data-target="#datetimepicker3" readonly="readonly" autocomplete="off" name="time_start" placeholder="Enter Time">
                                </div>
                                <!--end::Input-->
                                
                                <button type="submit" class="btn btn-dark font-weight-bold btn-hover-light-primary mt-3 mt-sm-0 px-7">Search</button>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--begin::Advanced Search-->
                        <div class="mt-4 my-md-0 mx-md-10">
                            <a href="#" class="text-white font-weight-bolder text-hover-primary">Advanced Search</a>
                        </div>
                        <!--end::Advanced Search-->
                    </div>
                    <!--end::Search Bar-->
                </div>
            </div>
        </div>
    </div>
</div>

{{-- end row --}}

<div class="row">
    <div class="col-lg-12">
        <div class="d-flex align-items-baseline flex-wrap">
            <h5 class="text-dark font-weight-bold my-1 mr-5">Browse by Stable</h5>
        </div>
    </div>
</div>
{{-- end row --}}

<div class="lastest-competitions">
    <div class="row">
        @foreach ($stables_footer as $stable)
            <div class="col-md-3 p-5">
                <div class="card">
                    @if ($stable->logo)
                    <img src="{{ asset($stable->logo) }}" class="card-img-top min-h-275px" alt="{{ $stable->name }}">   
                    @else
                    <img src="assets/media/branchsto/lastest-competition.png" class="card-img-top min-h-275px" alt="{{ $stable->name }}">   
                    @endif
                    <div class="card-body p-5">
                    <h5 class="card-title d-flex align-items-center justify-content-between">
                        <a href="{{ route('riding_class.search') }}?stable_name={{ $stable->name }}">
                            {{ $stable->name }}
                        </a>
                        <div class="star-rating">
                            <span class="far fa-star" data-rating="1"></span>
                            <span class="far fa-star" data-rating="2"></span>
                            <span class="far fa-star" data-rating="3"></span>
                            <span class="far fa-star" data-rating="4"></span>
                            <span class="far fa-star" data-rating="5"></span>
                            <input type="hidden" name="rating_stable" class="rating-value" value="2.56">
                        </div>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $stable->city->name }}</h6>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex align-items-center flex-wrap p5-10 justify-content-center">
            <div class="d-flex flex-wrap py-2 mr-3">
                {{ $stables_footer->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@endsection

@include('riding-class.scripts')