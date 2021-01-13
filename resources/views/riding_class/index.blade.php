@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('riding-class') }}
@endsection

@section('content')
<style>
    body {
        overflow-x: hidden;
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
                            <form class="form d-flex align-items-md-center flex-sm-row flex-column flex-grow-1 flex-sm-grow-0">
                                <!--begin::Input-->
                                <div class="d-flex align-items-center py-3 py-sm-0 px-sm-3">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo4/dist/assets/media/svg/icons/General/Search.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <input type="text" class="form-control border-0 font-weight-bold pl-2" placeholder="Enter Stable Name">
                                </div>
                                <!--end::Input-->

                                <!--begin::Input-->
                                <span class="bullet bullet-ver h-25px d-none d-sm-flex mr-2"></span>

                                <div class="d-flex align-items-center py-3 py-sm-0 px-sm-3">
                                    <span class="svg-icon svg-icon-lg">
                                        <i class="far fa-calendar-plus"></i>
                                    </span>
                                    <input type="text" class="form-control border-0 font-weight-bold pl-2" placeholder="Enter Date">
                                </div>
                                <!--end::Input-->

                                <!--begin::Input-->
                                <span class="bullet bullet-ver h-25px d-none d-sm-flex mr-2"></span>

                                <div class="d-flex align-items-center py-3 py-sm-0 px-sm-3">
                                    <span class="svg-icon">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo4/dist/assets/media/svg/icons/General/Search.svg-->
                                        <img src="assets/media/svg/icons/Code/Time-schedule.svg"/>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <input type="text" class="form-control border-0 font-weight-bold pl-2" placeholder="Enter Time">
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
        <div class="col-md-3 p-5">
            <div class="card">
                <img src="assets/media/branchsto/lastest-competition.png" class="card-img-top" alt="nama stable">
                <div class="card-body p-5">
                  <h5 class="card-title">Branchsto</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Rating Stable</h6>
                </div>
              </div>
        </div>
        <div class="col-md-3 p-5">
            <div class="card">
                <img src="assets/media/branchsto/lastest-competition.png" class="card-img-top" alt="nama stable">
                <div class="card-body p-5">
                  <h5 class="card-title">Branchsto</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Rating Stable</h6>
                </div>
              </div>
        </div>
        <div class="col-md-3 p-5">
            <div class="card">
                <img src="assets/media/branchsto/lastest-competition.png" class="card-img-top" alt="nama stable">
                <div class="card-body p-5">
                  <h5 class="card-title">Branchsto</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Rating Stable</h6>
                </div>
              </div>
        </div>
        <div class="col-md-3 p-5">
            <div class="card">
                <img src="assets/media/branchsto/lastest-competition.png" class="card-img-top" alt="nama stable">
                <div class="card-body p-5">
                  <h5 class="card-title">Branchsto</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Rating Stable</h6>
                </div>
              </div>
        </div>
        <div class="col-md-3 p-5">
            <div class="card">
                <img src="assets/media/branchsto/lastest-competition.png" class="card-img-top" alt="nama stable">
                <div class="card-body p-5">
                  <h5 class="card-title">Branchsto</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Rating Stable</h6>
                </div>
              </div>
        </div>
        <div class="col-md-3 p-5">
            <div class="card">
                <img src="assets/media/branchsto/lastest-competition.png" class="card-img-top" alt="nama stable">
                <div class="card-body p-5">
                  <h5 class="card-title">Branchsto</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Rating Stable</h6>
                </div>
              </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
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
