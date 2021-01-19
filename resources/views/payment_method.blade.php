@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('riding-class') }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b">
            <div class="car-body px-5 py-8">
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                <div class="symbol-label" style="background-image:url({{ asset('assets/media/users/300_21.jpg') }})"></div>
                                <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Nama Stable</a>
                                <div class="text-muted">Package Regular A</div>
                            </div>
                        </div>

                        <h4 class="font-weight-bold mb-5">
                            Select Payment Method
                        </h4>

                        <ul class="nav flex-column nav-pills">
                            <li class="nav-item mb-2">
                                <a class="nav-link active" id="home-tab-5" data-toggle="tab" href="#home-5">
                                    <span class="nav-text font-size-h4">Bank Transfer</span>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link" id="profile-tab-5" data-toggle="tab" href="#profile-5" aria-controls="profile">
                                    <span class="nav-text font-size-h4">Virtual Account</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab-5" data-toggle="tab" href="#contact-5" aria-controls="contact">
                                    <span class="nav-text font-size-h4">OVO</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-8">
                        <div class="tab-content" id="myTabContent5">
                            <div class="tab-pane fade active show" id="home-5" role="tabpanel" aria-labelledby="home-tab-5">
                                <h3 class="font-weight-bold mb-5">
                                    Bank Transfer
                                </h3>
                                
                                <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
                                    <div class="alert-icon">
                                        <i class="flaticon2-information"></i>
                                    </div>
                                    <div class="alert-text text-dark font-weight-light font-size-h5">
                                        You can transfer from any banking channel(m-banking, SMS banking or ATM)
                                    </div>
                                </div>
                                
                                <span class="font-size-h4 font-weight-light mb-5">
                                    Select a Destination Account
                                </span>

                                <div class="card my-5">
                                    <div class="card-body p-5">
                                        <div class="d-flex align-items-center justify-content-between flex-lg-wrap flex-xl-nowrap">
                                            <div class="d-flex flex-column">
                                                <div class="radio-inline">
                                                    <label class="radio radio-outline radio-outline-2x radio-primary font-size-h2 ml-3">
                                                    <input type="radio" name="radios1">
                                                    <span></span>BCA Transfer</label>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <img width="100px" src="http://localhost:8000/assets/media/branchsto/mandiri.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card my-5">
                                    <div class="card-body p-5">
                                        <div class="d-flex align-items-center justify-content-between flex-lg-wrap flex-xl-nowrap">
                                            <div class="d-flex flex-column">
                                                <div class="radio-inline">
                                                    <label class="radio radio-outline radio-outline-2x radio-primary font-size-h2 ml-3">
                                                    <input type="radio" name="radios1">
                                                    <span></span>BRI Transfer</label>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <img width="100px" src="http://localhost:8000/assets/media/branchsto/mandiri.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card my-5">
                                    <div class="card-body p-5">
                                        <div class="d-flex align-items-center justify-content-between flex-lg-wrap flex-xl-nowrap">
                                            <div class="d-flex flex-column">
                                                <div class="radio-inline">
                                                    <label class="radio radio-outline radio-outline-2x radio-primary font-size-h2 ml-3">
                                                    <input type="radio" name="radios1">
                                                    <span></span>Bank BNI</label>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <img width="100px" src="http://localhost:8000/assets/media/branchsto/mandiri.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card my-5">
                                    <div class="card-body p-5">
                                        <div class="d-flex align-items-center justify-content-between flex-lg-wrap flex-xl-nowrap">
                                            <div class="d-flex flex-column">
                                                <div class="radio-inline">
                                                    <label class="radio radio-outline radio-outline-2x radio-primary font-size-h2 ml-3">
                                                    <input type="radio" name="radios1">
                                                    <span></span>Bank Mandiri</label>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <img width="100px" src="http://localhost:8000/assets/media/branchsto/mandiri.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-custom gutter-b bg-light">
                                    <div class="card-body p-5">
                                        <div class="d-flex">
                                            <!--begin: Info-->
                                            <div class="flex-grow-1">
                                                <div class="d-flex">
                                                    <div class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-3">
                                                        Price Details
                                                    </div>
                                                </div>
                        
                                                <!--Start::Dashed Line-->
                                                <div class="separator separator-dashed separator-border-2 my-3"></div>
                                                <!--End::Dashed Line-->
                        
                                                <div class="d-flex justify-content-between mb-3">
                                                    <div class="row">
                                                        <div class="col-md-6 font-weight-bolder">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia laudantium illo aliquam. Accusamus esse sapiente quia tenetur quas possimus quis nul
                                                        </div>
                                                        <div class="col-md-6 text-right mt-3 mt-md-0">
                                                            <h3 class="font-weight-bolder">
                                                                Rp. 400.000
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="d-flex justify-content-between">
                                                    <div class="row text-success">
                                                        <div class="col-md-6">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia laudantium illo aliquam. Accusamus esse sapiente quia tenetur quas possimus quis nul
                                                        </div>
                                                        <div class="col-md-6 text-right mt-3 mt-md-0">
                                                            <h3 class="font-weight-bolder">
                                                                Rp. 400.000
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                        
                                    <div class="card-footer d-flex justify-content-between p-5">
                                        <h3 class="text-dark font-weight-bolder">Total:</h3>
                                        <h3 class="text-dark font-weight-bolder">Rp. 80.000.000</h3>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <div class="row">
                                        <div class="col-md-8">
                                            By clicking this button, you ackowladge than you hav read amd agreed to the 
                                        <a href="#">Terms &amp; Conditions</a>
                                        and <a href="#">Privacy Policy</a> of Equinride
                                        </div>
                                        <div class="col-md-4 mt-3 mt-md-0">
                                            <button class="btn btn-block font-weight-bolder btn-warning py-5">
                                                Pay with Bank Transfer
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
                                <h3 class="font-weight-bold mb-5">
                                    Bank Transfer
                                </h3>
                                
                                <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
                                    <div class="alert-icon">
                                        <i class="flaticon2-information"></i>
                                    </div>
                                    <div class="alert-text text-dark font-weight-light font-size-h5">
                                        You can transfer from any banking channel(m-banking, SMS banking or ATM)
                                    </div>
                                </div>
                                
                                <span class="font-size-h4 font-weight-light mb-5">
                                    Select a Destination Account
                                </span>

                                <div class="card my-5">
                                    <div class="card-body p-5">
                                        <div class="d-flex align-items-center justify-content-between flex-lg-wrap flex-xl-nowrap">
                                            <div class="d-flex flex-column">
                                                <div class="radio-inline">
                                                    <label class="radio radio-outline radio-outline-2x radio-primary font-size-h2 ml-3">
                                                    <input type="radio" name="radios1">
                                                    <span></span>BCA Transfer</label>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <img width="100px" src="http://localhost:8000/assets/media/branchsto/mandiri.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card my-5">
                                    <div class="card-body p-5">
                                        <div class="d-flex align-items-center justify-content-between flex-lg-wrap flex-xl-nowrap">
                                            <div class="d-flex flex-column">
                                                <div class="radio-inline">
                                                    <label class="radio radio-outline radio-outline-2x radio-primary font-size-h2 ml-3">
                                                    <input type="radio" name="radios1">
                                                    <span></span>BRI Transfer</label>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <img width="100px" src="http://localhost:8000/assets/media/branchsto/mandiri.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card my-5">
                                    <div class="card-body p-5">
                                        <div class="d-flex align-items-center justify-content-between flex-lg-wrap flex-xl-nowrap">
                                            <div class="d-flex flex-column">
                                                <div class="radio-inline">
                                                    <label class="radio radio-outline radio-outline-2x radio-primary font-size-h2 ml-3">
                                                    <input type="radio" name="radios1">
                                                    <span></span>Bank BNI</label>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <img width="100px" src="http://localhost:8000/assets/media/branchsto/mandiri.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card my-5">
                                    <div class="card-body p-5">
                                        <div class="d-flex align-items-center justify-content-between flex-lg-wrap flex-xl-nowrap">
                                            <div class="d-flex flex-column">
                                                <div class="radio-inline">
                                                    <label class="radio radio-outline radio-outline-2x radio-primary font-size-h2 ml-3">
                                                    <input type="radio" name="radios1">
                                                    <span></span>Bank Mandiri</label>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <img width="100px" src="http://localhost:8000/assets/media/branchsto/mandiri.png" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact-5" role="tabpanel" aria-labelledby="contact-tab-5">
                                <p>
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati quae, quisquam officiis dolor aliquid est eos suscipit. Similique quas laudantium minus nobis incidunt autem deserunt ducimus, blanditiis modi veritatis itaque.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- next payment start --}}
    <div class="col-lg-4 col-xl-3">
        <div class="card card-custom">
            <div class="card-header align-items-center justify-content-between">
                <div class="font-size-h4">
                    BOOKING ID
                </div>
                <div class="font-size-h4 font-weight-bold">
                    212013914
                </div>
            </div>
            <div class="card-body py-5">                    
                <div class="font-size-h4 mb-2">
                    BOOKING DETAILS
                </div>
                <div class="d-flex align-items-center">
                    <span class="label label-dot label-dark"></span>
                    <p class="ml-2 mb-0">
                        Tuesday, June 20th 2020
                    </p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="label label-dot label-dark"></span>
                    <p class="ml-2 mb-0">
                        07:00 - 08:00
                    </p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="label label-dot label-dark"></span>
                    <p class="ml-2 mb-0">
                        Wild Horse
                    </p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="label label-dot label-dark"></span>
                    <p class="ml-2 mb-0">
                        This is the most effective riding package for beginners who want to become professionals
                    </p>
                </div>
            </div>
            <div class="card-footer py-5">
                <div class="font-size-h4 mb-2">
                    GUEST
                </div>
                <div class="font-size-h4 font-weight-bold">
                    Yudi
                </div>
            </div>
        </div>
    </div>
</div>

@endsection