<div class="tab-pane fade active show" id="bank-transfer" role="tabpanel" aria-labelledby="bank-transfer-tab">
    <h3 class="font-weight-bold mb-5">
        Bank Transfer
    </h3>
    
    <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon2-information"></i>
        </div>
        <div class="alert-text text-dark font-weight-light font-size-h5">
            You can transfer from any banking channel (m-banking, SMS banking or ATM)
        </div>
    </div>
    
    <span class="font-size-h4 font-weight-light mb-5">
        Select a Destination Account
    </span>

    <form id="bank-transfer-form" action="{{ route('package.payment_confirmation', ['package' => $package->id]) }}" method="POST">
        
        @csrf

        <input type="hidden" name="date_start" value="{{ \Carbon\Carbon::parse($package->stable->slot->first()->date)->format('D, d M Y') }}">
        <input type="hidden" name="time_start" value="{{ \Carbon\Carbon::parse($package->stable->slot->first()->time_start)->format('H:i') }}">

        <input type="hidden" name="payment_method" value="bank-transfer">

        @forelse ($bank_payments as $bank_payment)
        <div class="card my-5">
            <div class="card-body p-5">
                <div class="d-flex align-items-center justify-content-between flex-lg-wrap flex-xl-nowrap">
                    <div class="d-flex flex-column">
                        <div class="radio-inline">
                            <label class="radio radio-outline radio-outline-2x radio-primary font-size-h2 ml-3">
                            <input type="radio" name="bank_payment_id" value="{{ $bank_payment->id }}">
                            <span></span>{{ $bank_payment->branch }}</label>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <img width="100px" src="http://localhost:8000/assets/media/branchsto/mandiri.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        @empty
            No Bank Payments Available Yet
        @endforelse
    </form>

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

                    <div class="d-flex align-items-center flex-wrap justify-content-between mb-3">
                        <div class="font-weight-bolder font-size-h5 text-dark">
                            [{{ $package->attendance }}x] {{ $package->stable->name }}, {{ $package->name }}
                        </div>
                        <div class="text-right mt-3 mt-md-0">
                            <h3 class="font-weight-bolder font-size-h5 text-dark">
                                Rp. {{ number_format($package->price, 0, ",", ".") }}
                            </h3>
                        </div>
                    </div>

                    <div class="d-flex align-items-center flex-wrap justify-content-between mb-3">
                        <div class="font-weight-bolder font-size-h5 text-success">
                            Taxes and Other Fees
                        </div>
                        <div class="text-right mt-3 mt-md-0">
                            <h3 class="font-weight-bolder font-size-h5 text-success">
                                Included
                            </h3>
                        </div>
                    </div>

                </div>
                <!--end::Info-->
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between p-5">
            <h3 class="text-dark font-weight-bolder">Total:</h3>
            <h3 class="text-dark font-weight-bolder">Rp. {{ number_format($package->price, 0, ",", ".") }}</h3>
        </div>
    </div>

    <div class="mb-5">
        <div class="row">
            <div class="col-md-7">
                By clicking this button, you ackowladge than you hav read amd agreed to the 
            <a href="#">Terms &amp; Conditions</a>
            and <a href="#">Privacy Policy</a> of Equinride
            </div>
            <div class="col-md-5 mt-3 mt-md-0">
                <button class="btn btn-block font-weight-bolder btn-warning py-5" onclick="event.preventDefault();document.getElementById('bank-transfer-form').submit();">
                    Pay with Bank Transfer
                </button>
            </div>
        </div>
    </div>

</div>