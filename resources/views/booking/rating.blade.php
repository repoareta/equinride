@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('order-history') }}
@endsection

@push('page-styles')
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link href='{{ asset('jquery-bar-rating-master/dist/themes/fontawesome-stars.css') }}' rel='stylesheet' type='text/css'>
@endpush

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('user._aside')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Rate Stable, Horse And Coach</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Stable : {{ $stable->name }}</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <form action="{{ route('user.order_history.rating.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="stable_id" value="{{ $stable->id }}">
                                    <input type="hidden" name="horse_id" value="{{ $horse->id }}">
                                    <input type="hidden" name="coach_id" value="{{ $coach->id }}">
                                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                                    <input type="hidden" name="booking_detail_id" value="{{ $id }}">
                                    <h4 class="font-weight-bolder text-dark">Stable</h4>
                                    <div class="d-flex align-items-center mb-10">
                                        <div class="d-flex align-items-center mr-5">
                                            <div class="symbol symbol-40 symbol-light-primary mr-3 flex-shrink-0">
                                                <div class="symbol-label" style="background-image: url('{{ asset( $stable->photo ) }}')"></div>
                                            </div>
                                            <div>
                                                <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{ $stable->name }}</a>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">{{ $stable->address }}</div>
                                            </div>
                                        </div>
                                        <select class='rating' name="stable_rate">
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                        </select>
                                    </div>
                                    <h4 class="font-weight-bolder text-dark">Package</h4>
                                    <div class="d-flex align-items-center mb-10">
                                        <div class="d-flex align-items-center mr-5">
                                            <div class="symbol symbol-40 symbol-light-primary mr-3 flex-shrink-0">
                                                <div class="symbol-label" style="background-image: url('{{ asset( $package->photo ) }}')"></div>
                                            </div>
                                            <div>
                                                <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{ $package->name }}</a>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">{{ 'Rp. '. number_format($package->price, 0, ',', '.') }}</div>
                                            </div>
                                        </div>
                                        <select class='rating' name="package_rate">
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                        </select>
                                    </div>
                                    <h4 class="font-weight-bolder text-dark">Horse</h4>
                                    <div class="d-flex align-items-center mb-10">
                                        <div class="d-flex align-items-center mr-5">
                                            <div class="symbol symbol-40 symbol-light-primary mr-3 flex-shrink-0">
                                                <div class="symbol-label" style="background-image: url('{{ asset( $horse->photo ) }}')"></div>
                                            </div>
                                            <div>
                                                <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{ $horse->name }}</a>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">{{ date('D, m d Y', strtotime($horse->birth_date)) }}</div>
                                            </div>
                                        </div>
                                        <select class='rating' name="horse_rate">
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                        </select>
                                    </div>
                                    <h4 class="font-weight-bolder text-dark">Coach</h4>
                                    <div class="d-flex align-items-center mb-10">
                                        <div class="d-flex align-items-center mr-5">
                                            <div class="symbol symbol-40 symbol-light-primary mr-3 flex-shrink-0">
                                                <div class="symbol-label" style="background-image: url('{{ asset( $coach->photo ) }}')"></div>
                                            </div>
                                            <div>
                                                <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{ $coach->name }}</a>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">{{ date('D, m d Y', strtotime($coach->birth_date)) }}</div>
                                            </div>
                                        </div>
                                        <select class='rating' name="coach_rate">
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Save</button>
                                    <a href="{{ route('user.order_history.index') }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection
@push('page-scripts')
<script src="{{ asset('jquery-bar-rating-master/dist/jquery.barrating.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {

        $('.rating').barrating({
            theme: 'fontawesome-stars',
            initialRating: '0'
        });
    });
</script>
@endpush
