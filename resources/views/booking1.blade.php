@extends('layouts.app')

@section('content')

<h1 class="font-weight-normal mb-10">Please Review Your Booking</h1>
<h2 class="font-weight-light mb-3">Your Information</h2>
<div class="row">
    <div class="col-lg-8 col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-body p-5">
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-150">
                            <img alt="Pic" src="https://equinride.com/assets/media//users/300_1.jpg">
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                            <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                    <!--begin::Name-->
                                    <p class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-3">Regular Package A</p>
                                    <!--end::Name-->
                                </div>
                            </div>
                            <!--Start::Dashed Line-->
                            <div class="separator separator-dashed separator-border-2 my-3"></div>
                            <!--End::Dashed Line-->
                            <!--begin::User-->
                        <!--end::Title-->
                        <div class="row mr-30">
                            <div class="col-md-4">
                                <h6>Date</h6>
                                <p>15-06-2021</p>
                            </div>
    
                            <div class="col-md-4">
                                <h6>Time Start</h6>
                                <p>08:00</p>
                            </div>
    
                            <div class="col-md-4">
                                <h6>Time Start</h6>
                                <p>08:00</p>
                            </div>

                            <div class="col-md-4">
                                <h6>Guest Name</h6>
                                <p>Yudi</p>
                            </div>
                        </div>

                        <!--Start::Dashed Line-->
                        <div class="separator separator-dashed separator-border-2 my-3"></div>
                        <!--End::Dashed Line-->

                        <div class="row">
                            <div class="col-12">
                                <h6>Riding Class Details</h6>
                                <div class="row">
                                    <div class="col-md-2 my-5">
                                        Stable
                                    </div>
                                    <div class="col-md-10 my-5">
                                        Wild Horse
                                    </div>
                                    <div class="col-md-2 my-5">
                                        Description
                                    </div>
                                    <div class="col-md-10 my-5 text-justify">
                                        This is the most effective riding package for beginners who want to become professionals
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-4">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <p class="text-justify">
                    By clicking this button, you ackowladge than you hav read amd agreed to the <a href="#">Terms & Conditions</a>
                    and <a href="#">Privacy Policy</a> of Equinride 
                </p>
                <button class="btn btn-block font-weight-bolder btn-warning">Continue to Payment</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-body p-5">
                <div class="d-flex">
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                            <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                    <!--begin::Name-->
                                    <a href="#" class="d-flex align-items-center text-dark font-size-h5 font-weight-bold mr-3">Reschedule Policy</a>
                                    <!--end::Name-->
                                </div>
                            </div>
                            <!--Start::Dashed Line-->
                            <div class="separator separator-dashed separator-border-2 my-3"></div>
                            <!--End::Dashed Line-->
                            <!--begin::User-->
                        <!--end::Title-->
                        <div class="row mr-30">
                            <div class="col-12">
                                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus beatae ab at eligendi a similique dolore unde libero quisquam nemo, impedit odit praesentium eius natus quibusdam. Ipsum officia accusamus repellendus voluptatibus officiis sunt? Animi, expedita iste vel qui explicabo inventore exercitationem, ipsa, sunt vitae temporibus earum distinctio eius id modi?</p>
                            </div>
                        </div>

                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>
    </div>
</div>

<h2 class="font-weight-light mb-3">Price Details</h2>
@endsection