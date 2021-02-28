@php
    // Load models
    use App\Models\Stable;
    use App\Models\Booking;
    use App\Models\User;
    use App\Models\BankPayment;
    use App\Models\HorseSex;
    use App\Models\HorseBreed;

    // total admin
    $count_admin =  User::whereHas('roles', function ($q){
                        $q->where('name', 'app-admin');
                    })->count();
    
    // Total bank 
    $count_bank =   BankPayment::count();
    
    // Total horse sex
    $count_horse_sex =  HorseSex::count();

    // Total horse breed
    $count_horse_breed =  HorseBreed::count();

    // Total booking
    $count_booking = Booking::where('approval_status', null)->count();

    // Total Stable Step 1 need approve
    $count_stable_1 = Stable::where('approval_status', 'Step 1 Need Approval')->count();

    // Total Stable Step 1 need approve
    $count_stable_2 = Stable::where('approval_status', 'Step 2 Need Approval')->count();

@endphp

<div class="flex-row-auto offcanvas-mobile w-350px w-xxl-350px" id="kt_profile_aside">
    <!--begin::Profile Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Body-->
        <div class="card-body pt-4">
            <!--begin::User-->
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    @if(Auth::user()->photo)
                        <div class="symbol-label" style="background-image:url('{{ asset(Auth::user()->photo) }}')"></div>
                    @else
                        <div class="symbol-label" style="background-image:url('{{ asset('assets/media/branchsto/profile.png') }}')"></div>
                    @endif
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div>
                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{ Auth::user()->name }}</a>
                    <div class="text-muted">App Owner</div>
                </div>
            </div>
            <!--end::User-->
            <!--begin::Contact-->
            <div class="py-9">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Email:</span>
                    <a href="#" class="text-muted text-hover-primary">{{ Auth::user()->email }}</a>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="font-weight-bold mr-2">Phone:</span>
                    <span class="text-muted">{{ Auth::user()->phone }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="font-weight-bold mr-2">Location:</span>
                    <span class="text-muted">{{ Auth::user()->address }}</span>
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
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                
                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.stable.approval.*') ? 'active' : '' }}" href="#stableApprovalSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-chess-knight"></i>
                        </span>
                        <span class="navi-text">Stable Approval</span>
                        <span class="navi-label">
                            <span class="label label-light-danger font-weight-bold">
                                {{ $count_stable_1 + $count_stable_2 }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>

                    <ul class="collapse list-unstyled mt-2 {{ Route::is('app_owner.stable.approval.*') ? 'show' : '' }}" id="stableApprovalSubmenu">
                        <li class="navi-item mb-2 pl-3">
                            <a class="navi-link py-4 {{ Route::is('app_owner.stable.approval.step_1.index') ? 'active' : '' }}" href="{{ route('app_owner.stable.approval.step_1.index') }}">
                                <span class="navi-icon mr-2">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <span class="navi-text">Approval Step 1</span>
                                <span class="navi-label">
                                    <span class="label label-light-danger font-weight-bold">
                                        {{ $count_stable_1 }}
                                    </span>
                                </span>
                                <span class="navi-arrow"></span>
                            </a>
                        </li>

                        <li class="navi-item mb-2 pl-3">
                            <a class="navi-link py-4 {{ Route::is('app_owner.stable.approval.step_2.index') ? 'active' : '' }}" href="{{ route('app_owner.stable.approval.step_2.index') }}">
                                <span class="navi-icon mr-2">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <span class="navi-text">Approval Step 2</span>
                                <span class="navi-label">
                                    <span class="label label-light-danger font-weight-bold">
                                        {{ $count_stable_2 }}
                                    </span>
                                </span>
                                <span class="navi-arrow"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4" href="#">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-wallet"></i>
                        </span>
                        <span class="navi-text">Withdraw Request</span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.payment.verification') ? 'active' : '' }}" href="{{ route('app_owner.payment.verification') }}">
                        <span class="navi-icon mr-2">
                            <i class="fab fa-buffer"></i>
                        </span>
                        <span class="navi-text">Package Payment</span>
                        <span class="navi-label">
                            <span class="label label-light-danger font-weight-bold">
                                {{ $count_booking }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>

                <li class="navi-section mt-5 text-primary text-uppercase font-weight-bolder pb-0">Settings</li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.horse.*') ? 'active' : '' }}" href="#horseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <span class="navi-icon mr-2">
                            <i class="la la-horse-head icon-xl"></i>
                        </span>
                        <span class="navi-text">Horse</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $count_horse_sex + $count_horse_breed }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>

                    <ul class="collapse list-unstyled mt-2 {{ Route::is('app_owner.horse.*') ? 'show' : '' }}" id="horseSubmenu">
                        <li class="navi-item mb-2 pl-3">
                            <a class="navi-link py-4 {{ Route::is('app_owner.horse.horse_sex.*') ? 'active' : '' }}" href="{{ route('app_owner.horse.horse_sex.index') }}">
                                <span class="navi-icon mr-2">
                                    <i class="la la-horse icon-xl"></i>
                                </span>
                                <span class="navi-text">Horse Sex</span>
                                <span class="navi-label">
                                    <span class="label label-light-primary font-weight-bold">
                                        {{ $count_horse_sex }}
                                    </span>
                                </span>
                                <span class="navi-arrow"></span>
                            </a>
                        </li>

                        <li class="navi-item mb-2 pl-3">
                            <a class="navi-link py-4 {{ Route::is('app_owner.horse.horse_breed.*') ? 'active' : '' }}" href="{{ route('app_owner.horse.horse_breed.index') }}">
                                <span class="navi-icon mr-2">
                                    <i class="la la-horse icon-xl"></i>
                                </span>
                                <span class="navi-text">Horse Breed</span>
                                <span class="navi-label">
                                    <span class="label label-light-primary font-weight-bold">
                                        {{ $count_horse_breed }}
                                    </span>
                                </span>
                                <span class="navi-arrow"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.bank.index') ? 'active' : '' }}" href="{{ route('app_owner.bank.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="la la-bank icon-xl"></i>
                        </span>
                        <span class="navi-text">Bank Account</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $count_bank }}
                            </span>
                        </span>
                        <span class="navi-arrow"></span>
                    </a>
                </li>
                
                <li class="navi-item mb-2">
                    <a class="navi-link py-4 {{ Route::is('app_owner.admin.*') ? 'active' : '' }}" href="{{ route('app_owner.admin.index') }}">
                        <span class="navi-icon mr-2">
                            <i class="fas fa-user-friends"></i>
                        </span>
                        <span class="navi-text">Admin Management</span>
                        <span class="navi-label">
                            <span class="label label-light-primary font-weight-bold">
                                {{ $count_admin }}
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