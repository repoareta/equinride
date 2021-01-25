<div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body pt-4">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end">
                <div class="dropdown dropdown-inline">
                    <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ki ki-bold-more-hor"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover py-5">
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-drop"></i>
                                    </span>
                                    <span class="navi-text">New Group</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-list-3"></i>
                                    </span>
                                    <span class="navi-text">Contacts</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-rocket-1"></i>
                                    </span>
                                    <span class="navi-text">Groups</span>
                                    <span class="navi-link-badge">
                                        <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-bell-2"></i>
                                    </span>
                                    <span class="navi-text">Calls</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-gear"></i>
                                    </span>
                                    <span class="navi-text">Settings</span>
                                </a>
                            </li>
                            <li class="navi-separator my-3"></li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-magnifier-tool"></i>
                                    </span>
                                    <span class="navi-text">Help</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="flaticon2-bell-2"></i>
                                    </span>
                                    <span class="navi-text">Privacy</span>
                                    <span class="navi-link-badge">
                                        <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
            </div>
            <!--end::Toolbar-->
            <!--begin::User-->
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    <div class="symbol-label" style="background-image:url('{{asset('assets/media/users/300_21.jpg')}}')"></div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div>
                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">James Jones</a>
                    <div class="text-muted">Application Developer</div>
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
                    <a class="navi-link py-4 {{ Route::is('app_owner.index') ? 'active' : '' }}" href="{{ route('app_owner.index') }}">
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
                    <a class="navi-link py-4 {{ Route::is('app_owner.stable.approval.*') ? 'active' : '' }}" href="#stableApprovalSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-chess-knight"></i>
                        </span>
                        <span class="navi-text">Stable Approval</span>
                        <span class="navi-arrow"></span>
                    </a>

                    <ul class="collapse list-unstyled mt-2" id="stableApprovalSubmenu">
                        <li class="navi-item mb-2 pl-3">
                            <a class="navi-link py-4 {{ Route::is('app_owner.stable.approval.step_1') ? 'active' : '' }}" href="{{ route('app_owner.stable.approval.step_1') }}">
                                <span class="navi-icon mr-2">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <span class="navi-text">Approval Step 1</span>
                            </a>
                        </li>

                        <li class="navi-item mb-2 pl-3">
                            <a class="navi-link py-4 {{ Route::is('app_owner.stable.approval.step_2') ? 'active' : '' }}" href="{{ route('app_owner.stable.approval.step_2') }}">
                                <span class="navi-icon mr-2">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <span class="navi-text">Approval Step 2</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-chess-knight"></i>
                        </span>
                        <span class="navi-text">Stable Withdraw</span>
                        <span class="navi-label">
                            <span class="label label-light-info font-weight-bold">2</span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#">
                        <span class="navi-icon mr-2">
                            <i class="fab fa-buffer"></i>
                        </span>
                        <span class="navi-text">Package Payment</span>
                        <span class="navi-label">
                            <span class="label label-inline label-light-primary font-weight-bold">Updated</span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-section mt-5 text-primary text-uppercase font-weight-bolder pb-0">Settings</li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#horseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="navi-icon mr-2">
                            <i class="la la-horse-head icon-xl"></i>
                        </span>
                        <span class="navi-text">Horse</span>
                        <span class="navi-arrow"></span>
                    </a>

                    <ul class="collapse list-unstyled" id="horseSubmenu">
                        <li class="navi-item mb-2 pl-3">
                            <a class="navi-link py-4" href="#">
                                <span class="navi-icon mr-2">
                                    <i class="la la-horse icon-xl"></i>
                                </span>
                                <span class="navi-text">Horse Sex</span>
                            </a>
                        </li>

                        <li class="navi-item mb-2 pl-3">
                            <a class="navi-link py-4" href="#">
                                <span class="navi-icon mr-2">
                                    <i class="la la-horse icon-xl"></i>
                                </span>
                                <span class="navi-text">Horse Breed</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#">
                        <span class="navi-icon mr-2">
                            <i class="la la-bank icon-xl"></i>
                        </span>
                        <span class="navi-text">Bank Account</span>
                        <span class="navi-label">
                            <span class="label label-inline label-light-success font-weight-bold">Pending</span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                
                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-user-friends"></i>
                        </span>
                        <span class="navi-text">Admin Management</span>
                        <span class="navi-label">
                            <span class="label label-inline label-light-danger font-weight-bold">New</span>
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