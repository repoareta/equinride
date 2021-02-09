
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
                        Complete your payment within <span id="time"></span>
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
                        @if ($bank_payment->photo)
                            <img class="w-100px h-35px" src="{{ asset($bank_payment->photo) }}" alt="{{ $bank_payment->branch }}">
                        @endif
                        {{-- <img width="100px" src="{{asset('assets/media/branchsto/mandiri.png')}}" alt=""> --}}                                        
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
                            Rp. {{ number_format($booking->price_total, 0, ",", ".") }}
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
                    @if ($booking->approval_status == null)
                        <form class="dropzone dropzone-default dropzone-primary dz-clickable" id="dropzoneDragArea" action="{{ route('package.payment_confirmation_submit') }}" method="post" enctype="multipart/form-data">                        
                        </form>                        
                    @endif
                </div>
            </div>                    
    </div>
    <!--end::Info-->
</div>


@push('page-scripts')
<script>
    Dropzone.autoDiscover = false;
    // Dropzone.options.createform = false;	
    let token = $('meta[name="csrf-token"]').attr('content');
    var dz = new Dropzone("#dropzoneDragArea", { 
        paramName: "photo",               
        addRemoveLinks: true,
        autoProcessQueue: false,
        acceptedFiles: ".jpeg,.jpg,.png",
        uploadMultiple: false,
        parallelUploads: 1,
        maxFiles: 1,
        params: {
            _token: token,
            id: {{ $booking->id }}
        },
        // The setting up of the dropzone
        init: function() {
                    var myDropzone = this;
                    //form submission code goes here

                    this.on("success", function (file, response) {
                        location.href = "{{ route('user.order_history.index') }}";
                        Swal.fire({
                            icon: 'success',
                            title: 'Payment Success',
                            text: 'Please waiting approval from app',
                            timer: 3000
                        });
                    });
                }
    });

    $('#submitForm').click(function(){
        dz.processQueue();
    });

    // Set the date we're counting down to
    var countDownDate = new Date("{{date('F d, Y G:i:s', strtotime($booking->created_at) + 60 * 60 ) }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
        
    // Find the distance between now and the count down date
    var distance = countDownDate - now;

        
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    
    // Output the result in an element with id="demo"
    document.getElementById("time").innerHTML =  minutes + ":" + seconds;
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("time").innerHTML = "EXPIRED";
    }
        
    }, 1000);
</script>
@endpush