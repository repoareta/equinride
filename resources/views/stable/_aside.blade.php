<div class="flex-row-auto offcanvas-mobile w-350px w-xxl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body pt-4">
            <!--begin::User-->
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    <div class="symbol-label" style="background-image:url('{{ asset('assets/media/users/300_21.jpg')}}')"></div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div>
                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                        {{ \App\Models\User::find(Auth::id())->stable->name }}
                    </a>
                    <div class="mt-2">
                        <span class="label label-inline label-danger font-weight-bold">Pending</span>
                    </div>
                </div>
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-9">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Email:</span>
                    <a href="#" class="text-muted text-hover-primary">matt@fifestudios.com</a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Phone:</span>
                    <span class="text-muted">44(76)34254578</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="font-weight-bold mr-2">Location:</span>
                    <span class="text-muted">Melbourne</span>
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
                        <span class="navi-label">
                            <span class="label label-light-info font-weight-bold">2</span>
                        </span>
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
                            <span class="label label-light-info font-weight-bold">2</span>
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
                            <span class="label label-inline label-light-primary font-weight-bold">Updated</span>
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
                        <span class="navi-label">
                            <span class="label label-inline label-light-danger font-weight-bold">New</span>
                        </span>
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
                            <span class="label label-inline label-light-success font-weight-bold">Pending</span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-id-card-alt"></i>
                        </span>
                        <span class="navi-text">Booking Order</span>
                        <span class="navi-label">
                            <span class="label label-inline label-light-success font-weight-bold">Pending</span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-wallet"></i>
                        </span>
                        <span class="navi-text">Withdrawals</span>
                        <span class="navi-label">
                            <span class="label label-inline label-light-success font-weight-bold">Pending</span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-section mt-5 text-primary text-uppercase font-weight-bolder pb-0">Settings</li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-hotel"></i>
                        </span>
                        <span class="navi-text">Stable Profile</span>
                        <span class="navi-label">
                            <span class="label label-inline label-light-success font-weight-bold">Pending</span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-house-user"></i>
                        </span>
                        <span class="navi-text">Admin Management</span>
                        <span class="navi-label">
                            <span class="label label-inline label-light-success font-weight-bold">Pending</span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                <li class="navi-item mb-2">
                    <div class="nav-link my-4">
                        <button type="submit" class="btn btn-sm btn-primary font-weight-bold mr-2 py-2 px-3 px-xxl-5">Submit All</button>
                    </div>
                </li>

            </ul>
            <!--end::Nav-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Profile Card-->
</div>