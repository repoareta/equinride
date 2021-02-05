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
                    {{ \Carbon\Carbon::parse($package->stable->slots->first()->date)->format('D, d M Y') }}
                </p>
            </div>
            <div class="d-flex align-items-center">
                <span class="label label-dot label-dark"></span>
                <p class="ml-2 mb-0">
                    {{ \Carbon\Carbon::parse($package->stable->slots->first()->time_start)->format('H:i') }} 
                    - 
                    {{ \Carbon\Carbon::parse($package->stable->slots->first()->time_end)->format('H:i') }}
                </p>
            </div>
            <div class="d-flex align-items-center">
                <span class="label label-dot label-dark"></span>
                <p class="ml-2 mb-0">
                    {{ $package->stable->name }}
                </p>
            </div>
            <div class="d-flex align-items-center">
                <span class="label label-dot label-dark"></span>
                <p class="ml-2 mb-0">
                    {{ $package->name }}
                </p>
            </div>
        </div>
        <div class="card-footer py-5">
            <div class="font-size-h4 mb-2">
                GUEST
            </div>
            <div class="font-size-h4 font-weight-bold">
                {{ ucwords(Auth::user()->name) }}
            </div>
        </div>
    </div>
</div>