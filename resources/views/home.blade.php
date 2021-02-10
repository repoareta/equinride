@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
        <div id="carouselExampleIndicators" class="carousel slide card-stretch" data-ride="carousel" >
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-content">
                        <h5 class="title">
                            RIDING CLASS FOR EVERYONE
                        </h5>
                        <p class="subtitle">
                            Choose a class that you can take according to your current abilities
                        </p>
                        <a href="{{ route('riding_class') }}" class="btn btn-warning">
                            <b>JOIN THE CLASS</b>
                        </a>
                    </div>
                    <div class="overlay"></div>
                    <img class="d-block w-100" src="{{asset('assets/media/branchsto/slider-img.png')}}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <div class="carousel-content">
                        <h5 class="title">
                            RIDING CLASS FOR EVERYONE
                        </h5>
                        <p class="subtitle">
                            Choose a class that you can take according to your current abilities
                        </p>
                        <a href="{{ route('riding_class') }}" class="btn btn-warning">
                            <b>JOIN THE CLASS</b>
                        </a>
                    </div>
                    <div class="overlay"></div>
                    <img class="d-block w-100" src="{{asset('assets/media/branchsto/slider-img.png')}}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <div class="carousel-content">
                        <h5 class="title">
                            RIDING CLASS FOR EVERYONE
                        </h5>
                        <p class="subtitle">
                            Choose a class that you can take according to your current abilities
                        </p>
                        <a href="{{ route('riding_class') }}" class="btn btn-warning">
                            <b>JOIN THE CLASS</b>
                        </a>
                    </div>
                    <div class="overlay"></div>
                    <img class="d-block w-100" src="{{asset('assets/media/branchsto/slider-img.png')}}" alt="Third slide">
                </div>
            </div>
        </div>
    </div>

    {{-- carousel end --}}

    <div class="col-xl-4">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label"># Rank</h3>
                </div>
                <div class="card-toolbar">
                    <ul class="nav nav-bold nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_7_1">Athlete</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_7_2">Club</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body pt-5">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_tab_pane_7_1" role="tabpanel" aria-labelledby="kt_tab_pane_7_1">
                        <div class="d-flex align-items-center flex-wrap mb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50 symbol-light mr-5">
                                <span class="symbol-label">
                                    <img src="assets/media/svg/avatars/004-boy-1.svg" class="h-50 align-self-center" alt="">
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 1</a>
                                <span class="text-muted font-weight-bold">Mark, Rowling, Esther</span>
                            </div>
                            <!--end::Text-->
                            <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                        </div>

                        <div class="d-flex align-items-center flex-wrap mb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50 symbol-light mr-5">
                                <span class="symbol-label">
                                    <img src="assets/media/svg/avatars/002-girl.svg" class="h-50 align-self-center" alt="">
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 2</a>
                                <span class="text-muted font-weight-bold">Mark, Rowling, Esther</span>
                            </div>
                            <!--end::Text-->
                            <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                        </div>

                        <div class="d-flex align-items-center flex-wrap mb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50 symbol-light mr-5">
                                <span class="symbol-label">
                                    <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 3</a>
                                <span class="text-muted font-weight-bold">Mark, Rowling, Esther</span>
                            </div>
                            <!--end::Text-->
                            <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                        </div>

                        <div class="text-center">
                            <a href="#" class="btn btn-primary font-weight-bold px-5 py-3">
                                View All
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kt_tab_pane_7_2" role="tabpanel" aria-labelledby="kt_tab_pane_7_2">
                        <div class="d-flex align-items-center flex-wrap mb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50 symbol-light mr-5">
                                <span class="symbol-label">
                                    <img src="assets/media/svg/misc/003-puzzle.svg" class="h-50 align-self-center" alt="">
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Club 1</a>
                                <span class="text-muted font-weight-bold">Mark, Rowling, Esther</span>
                            </div>
                            <!--end::Text-->
                            <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                        </div>

                        <div class="d-flex align-items-center flex-wrap mb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50 symbol-light mr-5">
                                <span class="symbol-label">
                                    <img src="assets/media/svg/misc/014-kickstarter.svg" class="h-50 align-self-center" alt="">
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Club 2</a>
                                <span class="text-muted font-weight-bold">Mark, Rowling, Esther</span>
                            </div>
                            <!--end::Text-->
                            <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                        </div>

                        <div class="d-flex align-items-center flex-wrap mb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50 symbol-light mr-5">
                                <span class="symbol-label">
                                    <img src="assets/media/svg/misc/014-kickstarter.svg" class="h-50 align-self-center" alt="">
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Club 3</a>
                                <span class="text-muted font-weight-bold">Mark, Rowling, Esther</span>
                            </div>
                            <!--end::Text-->
                            <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                        </div>

                        <div class="text-center">
                            <a href="#" class="btn btn-primary font-weight-bold px-5 py-3">
                                View All
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- first row end --}}

<div class="row">
    <div class="col-lg-12">
        <div class="d-flex align-items-baseline flex-wrap mr-5 mb-5 mt-5">
            <h5 class="text-dark font-weight-bold my-1 mr-5">Latest Competitions</h5>
            <span class="label label-inline label-pill label-danger label-rounded mr-2">Coming Soon</span>
        </div>
    </div>
</div>

<div class="lastest-competitions">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="assets/media/branchsto/lastest-competition.png" alt="Card image cap">
                <div class="card-body p-5">
                    <h5 class="card-title">JAKARTA HORSE EVENT</h5>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 1</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 2</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 3</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="assets/media/branchsto/lastest-competition.png" alt="Card image cap">
                <div class="card-body p-5">
                    <h5 class="card-title">JAKARTA HORSE EVENT</h5>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 1</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 2</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 3</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="assets/media/branchsto/lastest-competition.png" alt="Card image cap">
                <div class="card-body p-5">
                    <h5 class="card-title">JAKARTA HORSE EVENT</h5>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 1</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 2</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 3</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="assets/media/branchsto/lastest-competition.png" alt="Card image cap">
                <div class="card-body p-5">
                    <h5 class="card-title">JAKARTA HORSE EVENT</h5>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 1</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 2</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50 symbol-light mr-2">
                            <span class="symbol-label">
                                <img src="assets/media/svg/avatars/008-boy-3.svg" class="h-50 align-self-center" alt="">
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Top Rider 3</a>
                            <span class="text-muted font-weight-bold">Mark</span>
                        </div>
                        <!--end::Text-->
                        <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">2334</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
