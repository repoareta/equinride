<div class="flex-row-auto offcanvas-mobile w-350px w-xxl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body pt-4">
            <!--begin::User-->
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    <div class="symbol-label" style="background-image:url('{{ asset($stable->logo) }}"></div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div>
                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                        {{ $stable->name }}
                    </a>
                    <div class="mt-2">
                        @if ($stable->approval_status == 'Step 2 Approved')
                            <span class="label label-inline label-success font-weight-bold mb-2">
                                Ready to sell
                            </span>
                        @else
                            <span class="label label-inline label-warning font-weight-bold mb-2">
                                {{ $stable->approval_status }}
                            </span>                            
                        @endif

                        @if ($stable->approval_status == 'Step 1 Need Approval')
                            <div class="mt-2">
                                <p class="mb-0">Approval Step 1</p>
                                <form class="d-inline" id="formStepOne" method="POST" action="{{ route('app_owner.stable.approval.step_1.approval', ['stable' => $stable->id]) }}">
                                    @method('PUT')
                                    @csrf
                                        <button type="submit" class="btn btn-success font-weight-bold label label-inline" id="stepOneAccept">
                                            <i class="fas fa-check"></i> Approve
                                        </button>

                                        <button type="submit" class="btn btn-danger font-weight-bold label label-inline" id="stepOneDecline">
                                            <i class="fas fa-times"></i> Decline
                                        </button>
                                </form>                            
                            </div>                            
                        @endif

                        @if ($stable->approval_status == 'Step 2 Need Approval')
                            <div class="mt-2">
                                <p class="mb-0">Approval Step 2</p>
                                <form class="d-inline" id="formStepTwo" method="POST" action="{{ route('app_owner.stable.approval.step_2.approval', ['stable' => $stable->id]) }}">
                                    @method('PUT')
                                    @csrf
                                        <button type="submit" class="btn btn-success font-weight-bold label label-inline" id="stepTwoAccept">
                                            <i class="fas fa-check"></i> Approve
                                        </button>

                                        <button type="submit" class="btn btn-danger font-weight-bold label label-inline" id="stepTwoDecline">
                                            <i class="fas fa-times"></i> Decline
                                        </button>
                                </form>                            
                            </div>                            
                        @endif
                    </div>
                </div>
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-9">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Owner:</span>
                    <a href="#" class="text-muted text-hover-primary">{{ $stable->owner }}</a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Phone:</span>
                    <span class="text-muted">{{ $stable->contact_number }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="font-weight-bold mr-2">Location:</span>
                    <span class="text-muted">{{ $stable->address }}</span>
                </div>
            </div>
            <!--end::Contact-->
            <!--begin::Nav-->
            <ul class="navi navi-bold navi-hover navi-active navi-link-rounded">
                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.stable.approval.step_2.show') ? 'active' : '' }}" href="{{ route('app_owner.stable.approval.step_2.show',$stable->id) }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-hotel"></i>
                        </span>
                        <span class="navi-text">Stable Profile</span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.stable.horse') ? 'active' : '' }}" href="{{ route('app_owner.stable.horse',$stable->id) }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-horse"></i>
                        </span>
                        <span class="navi-text">Horse</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $stable->horses->count() }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.stable.package') ? 'active' : '' }}" href="{{ route('app_owner.stable.package', $stable->id) }}">
                        <span class="navi-icon mr-2">
                            <i class="fab fa-buffer"></i>
                        </span>
                        <span class="navi-text">Package</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $stable->packages->count() }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.stable.schedule') ? 'active' : '' }}" href="{{ route('app_owner.stable.schedule', $stable->id) }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <span class="navi-text">Schedule</span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.stable.coach') ? 'active' : '' }}" href="{{ route('app_owner.stable.coach',$stable->id) }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-user-friends"></i>
                        </span>
                        <span class="navi-text">Coach</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $stable->coaches->count() }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
            </ul>
            <!--end::Nav-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Profile Card-->
</div>

@push('page-scripts')
<script>
    $('body').on('click','#stepOneAccept', function(e) {

        e.preventDefault();
            
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            text: 'This is will be accepted the stable',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Accept',
            cancelButtonText: 'Cancel'
        }).then(function(getAction) {
            if (getAction.value) {
                $("<input />")
                .attr("type", "hidden")
                .attr("name", "approval")
                .attr("value", "approve")
                .appendTo("#formStepOne");

                $('#formStepOne').submit();
            }
        });
    });

    $('body').on('click','#stepOneDecline', function(e) {

        e.preventDefault();
            
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            text: 'This is will be declined the stable',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Accept',
            cancelButtonText: 'Cancel',
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function(getAction) {
            if (getAction.value) {
                $("<input />")
                .attr("type", "hidden")
                .attr("name", "approval")
                .attr("value", "decline")
                .appendTo("#formStepOne");

                $('#formStepOne').submit();
            }
        });
    });

    $('body').on('click','#stepTwoAccept', function(e) {

        e.preventDefault();
            
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            text: 'This is will be accepted the stable',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Accept',
            cancelButtonText: 'Cancel',
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function(getAction) {
            if (getAction.value) {
                $("<input />")
                .attr("type", "hidden")
                .attr("name", "approval")
                .attr("value", "approve")
                .appendTo("#formStepTwo");

                $('#formStepTwo').submit();
            }
        });
    });

    $('body').on('click','#stepTwoDecline', function(e) {

        e.preventDefault();
            
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            text: 'This is will be declined the stable',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Accept',
            cancelButtonText: 'Cancel',
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function(getAction) {
            if (getAction.value) {
                $("<input />")
                .attr("type", "hidden")
                .attr("name", "approval")
                .attr("value", "decline")
                .appendTo("#formStepTwo");

                $('#formStepTwo').submit();
            }
        });
    });
</script>
@endpush