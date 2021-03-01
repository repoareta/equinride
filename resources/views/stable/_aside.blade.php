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
                                Ready to Sell
                            </span>
                        @else
                            <span class="label label-inline label-warning font-weight-bold mb-2">
                                {{ $stable->approval_status }}
                            </span>                            
                        @endif
                        
                        @if ($stable->approval_status == 'Step 2 Need Approval')
                            <span class="label label-inline label-secondary font-weight-bold mb-2">
                                Step 2 Approval Request Sent
                            </span>
                        @else
                            <form id="formAccept" method="post" action="{{ route('stable.step_two_approval_request', ['stable' => $stable->id]) }}">
                                @method('PUT')
                                @csrf
                                <button id="submitApprove" class="btn btn-primary btn-sm font-weight-bold">
                                    <i class="fas fa-user-check"></i> Request Step 2 Approval
                                </button>
                            </form>
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
                    <a class="navi-link py-4 {{ Route::is('stable.index') ? 'active' : '' }}" href="{{ route('stable.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="fab fa-elementor"></i>
                        </span>
                        <span class="navi-text">Dashboard</span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('stable.horse.*') ? 'active' : '' }}" href="{{ route('stable.horse.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-horse"></i>
                        </span>
                        <span class="navi-text">Horse</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $stable->horses_count }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('stable.package.*') ? 'active' : '' }}" href="{{ route('stable.package.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="fab fa-buffer"></i>
                        </span>
                        <span class="navi-text">Package</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $stable->packages_count }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('stable.schedule.*') ? 'active' : '' }}" href="{{ route('stable.schedule.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <span class="navi-text">Schedule</span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('stable.coach.*') ? 'active' : '' }}" href="{{ route('stable.coach.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-user-friends"></i>
                        </span>
                        <span class="navi-text">Coach</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $stable->coaches_count }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('stable.booking.index') ? 'active' : '' }}" href="{{ route('stable.booking.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-id-card-alt"></i>
                        </span>
                        <span class="navi-text">Booking Order</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $stable->bookings->filter(function ($row) {
                                    return $row->approval_status == 'Accepted';
                                })->count() }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('stable.withdraw.index') ? 'active' : '' }}" href="{{ route('stable.withdraw.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-wallet"></i>
                        </span>
                        <span class="navi-text">Withdrawals</span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-section mt-5 text-primary text-uppercase font-weight-bolder pb-0">Settings</li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('stable.edit') ? 'active' : '' }}"" href="{{ route('stable.edit') }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-hotel"></i>
                        </span>
                        <span class="navi-text">Stable Profile</span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('stable.withdraw.setting') ? 'active' : '' }}"" href="{{ route('stable.withdraw.setting') }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-vote-yea"></i>
                        </span>
                        <span class="navi-text">Withdraw Method</span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="{{ route('stable.admin.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-house-user"></i>
                        </span>
                        <span class="navi-text">Admin Management</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{-- {{ $stable->col_stable_admin->count() }} --}} 0
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
    $('body').on('click','#submitApprove', function(e) {

        e.preventDefault();
            
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            text: "Stable will not ready to sell until administrator reviewed.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function(getAction) {
            if (getAction.value) {
                $('#formAccept').submit();
            }
        });
    });
</script>
@endpush