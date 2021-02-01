
<div class="d-flex">
    <!--begin: Info-->
    <div class="flex-grow-1">
        <!--begin::Title-->
            <!--begin::User-->
            <div class="d-flex align-items-center mt-5 mb-5">
                <span class="label label-xl label-primary">1</span>
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
                <span class="label label-xl label-primary">2</span>
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
                        <div class="font-size-h6 font-weight-bold">
                            {{ $bank_payment->branch }}
                        </div>
                        <img width="100px" src="{{asset('assets/media/branchsto/mandiri.png')}}" alt="">                                        
                    </div>
                    <div class="p-5 row">
                        <div class="font-size-h6 font-weight-normal col-md-3">
                            Account Number :
                        </div>
                        <div class="font-size-h6 font-weight-normal col-md-9">
                            {{ $bank_payment->account_number }}
                        </div>
                    </div>
                    <div class="p-5 row">
                        <div class="font-size-h6 font-weight-normal col-md-3">
                            Account Holder Name :
                        </div>
                        <div class="font-size-h6 font-weight-normal col-md-9">
                            {{ $bank_payment->account_name }}
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
                <span class="label label-xl label-primary">3</span>
                <div class="font-size-h4 font-weight-bold ml-3">
                    Complete Your Payment
                </div>
            </div>

            <div class="card border-0 mb-5">
                <div class="card-body p-0">
                    <form action="{{ route('package.payment_confirmation_submit', ['package' => $package->id]) }}" method="POST" id="payment-confirmation-form" class="dropzone dropzone-default dropzone-primary dz-clickable" enctype="multipart/form-data">
                        @csrf
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>
                </div>
            </div>                    
    </div>
    <!--end::Info-->
</div>


@push('page-scripts')
<script>
    $("#payment-confirmation-form").dropzone({
        autoProcessQueue: false,
        paramName: "file",
        maxFiles: 1,
        maxFilesize: 5,
        addRemoveLinks: !0
    });
</script>
@endpush