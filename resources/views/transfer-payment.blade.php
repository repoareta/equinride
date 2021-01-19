@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('riding-class') }}
@endsection

@section('content')
<div class="row" data-sticky-container="">
    <div class="col-lg-8 col-xl-9">
        <div class="card card-custom gutter-b">
            <div class="card-body p-5">

                <div class="alert alert-custom alert-notice alert-light-success fade show p-2" role="alert">
                    <div class="alert-icon"><i class="flaticon2-information"></i></div>
                    <div class="alert-text">Payment instructions have been sent to your email</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
                
                <div class="d-flex">
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                            <!--begin::User-->
                            <div class="d-flex align-items-center mt-5 mb-5">
                                <span class="label label-xl label-success">1</span>
                                <div class="font-size-h4 font-weight-bold ml-3">
                                    Make a Payment Before
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="font-size-h4 font-weight-bold">
                                        Today 03:31 AM
                                    </div>
                                    <p class="mb-0">
                                        Complete your payment within 17 minutes 41 seconds
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-10 mb-5">
                                <span class="label label-xl label-success">2</span>
                                <div class="font-size-h4 font-weight-bold ml-3">
                                    Please Transfer to:
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header p-5">
                                    <div class="d-flex align-items-center">
                                        <div><i class="flaticon-warning icon-xl"></i></div>
                                        <div class="ml-5">Payment instructions have been sent to your email</div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="bg-secondary p-5 d-flex justify-content-between align-items-center">
                                        <div class="font-size-h6 font-weight-bold ml-3">
                                            Bank Mandiri
                                        </div>
                                        <img width="100px" src="{{asset('assets/media/branchsto/mandiri.png')}}" alt="">                                        
                                    </div>
                                    <div class="p-5 row">
                                        <div class="font-size-h6 font-weight-normal col-md-3">
                                            Account Number :
                                        </div>
                                        <div class="font-size-h6 font-weight-normal col-md-9">
                                            165 00 66 77 0000
                                        </div>
                                    </div>
                                    <div class="p-5 row">
                                        <div class="font-size-h6 font-weight-normal col-md-3">
                                            Account Holder Name :
                                        </div>
                                        <div class="font-size-h6 font-weight-normal col-md-9">
                                            Ricardo Kaka
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-5">
                                    <div class="row">
                                        <div class="font-size-h6 font-weight-normal col-md-3">
                                            Transfer Amount :
                                        </div>
                                        <div class="font-size-h6 font-weight-normal col-md-9">
                                            Rp. 800.000
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-10 mb-5">
                                <span class="label label-xl label-success">3</span>
                                <div class="font-size-h4 font-weight-bold ml-3">
                                    Complete Your Payment
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body p-5">
                                    <form action="/file-upload" id="dropZone" class="dropzone dropzone-default dropzone-primary dz-clickable" enctype="multipart/form-data">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </form>
                                </div>
                            </div>
                    
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>

    </div>

    {{-- next payment start --}}
    <div class="col-lg-4 col-xl-3">
        <div class="card card-custom gutter-b">
            <div class="card-header align-items-center justify-content-between">
                <div class="font-size-h4 font-weight-bold">
                    BOOKING ID
                </div>
                <div class="font-size-h4 font-weight-bold">
                    212013914
                </div>
            </div>
            <div class="card-body">                    
                <div class="font-size-h4 font-weight-bold">
                    BOOKING DETAILS
                </div>
                <div class="d-flex align-items-center">
                    <span class="label label-dot label-success"></span>
                    <p class="ml-2 mb-0">
                        Tuesday, June 20th 2020
                    </p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="label label-dot label-success"></span>
                    <p class="ml-2 mb-0">
                        07:00 - 08:00
                    </p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="label label-dot label-success"></span>
                    <p class="ml-2 mb-0">
                        Wild Horse
                    </p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="label label-dot label-success"></span>
                    <p class="ml-2 mb-0">
                        This is the most effective riding package for beginners who want to become professionals
                    </p>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <div class="font-size-h4 font-weight-bold">
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
@push('scripts')
    <script>
        $("#dropZone").dropzone({ 
            url: "https://keenthemes.com/scripts/void.php",
            paramName: "file",
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            accept: function(e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
            }
        });
    </script>
@endpush