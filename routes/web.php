<?php

use Illuminate\Support\Facades\Route;

// CUSTOM LOAD FACADES
use Illuminate\Support\Facades\Auth;

// LOAD USER CONTROLLER START
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RidingClassController;
use App\Http\Controllers\UserController;
// USE 'AS' BECAUSE CONFLICT WITH STABLE PACKAGE CONTROLLER NAME
use App\Http\Controllers\PackageController as UserPackageController;
use App\Http\Controllers\BookingController as UserBookingController;

// LOAD USER CONTROLLER END

// LOAD STABLE CONTROLLER FOR STABLE OWNER AND STABLE ADMIN START
use App\Http\Controllers\Stable\StableController;
use App\Http\Controllers\Stable\HorseController;
use App\Http\Controllers\Stable\CoachController;
use App\Http\Controllers\Stable\PackageController;
use App\Http\Controllers\Stable\ScheduleController;
use App\Http\Controllers\Stable\WithdrawController;
use App\Http\Controllers\Stable\BookingController;
// USE 'AS' BECAUSE CONFLICT WITH APP OWNER PACKAGE CONTROLLER NAME
use App\Http\Controllers\Stable\AdminController as StableAdminController;

// LOAD STABLE CONTROLLER FOR STABLE OWNER AND STABLE ADMIN END

// LOAD APP OWNER CONTROLLER FOR APP OWNER AND APP ADMIN START
use App\Http\Controllers\AppOwner\DashboardController;
use App\Http\Controllers\AppOwner\BankPaymentController;
use App\Http\Controllers\AppOwner\HorseBreedController;
use App\Http\Controllers\AppOwner\HorseSexController;
use App\Http\Controllers\AppOwner\StableApprovalController;
use App\Http\Controllers\AppOwner\StableReviewController;
use App\Http\Controllers\AppOwner\UserPaymentApprovalController;

// LOAD APP OWNER CONTROLLER FOR APP OWNER AND APP ADMIN END

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/home');
    }
    return view('auth.login');
});

Auth::routes(['verify' => 'true']);

// MUST LOGIN AND VERIFIED ACCOUNT CAN ACCESS
Route::group(['middleware' => ['auth', 'verified']], function () {
    // HOME
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // USER || MEMBER START
    // USER PROFILE
    Route::group(['prefix' => 'user', 'as'=> 'user.'], function () {
        Route::post('/personal-information/media', [UserController::class, 'storeMedia'])->name('personal_information.media');
        Route::get('/personal-information', [UserController::class, 'index'])->name('personal_information');
        Route::put('/personal-information', [UserController::class, 'update'])->name('personal_information.update');
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('change_password');
        Route::put('/change-password', [UserController::class, 'changePasswordUpdate'])->name('change_password.update');
        Route::get('/order-history', [UserController::class, 'orderHistory'])->name('order_history');
    });

    // USER RIDING CLASS
    Route::get('/riding-class', [RidingClassController::class, 'index'])->name('riding_class');
    Route::get('/riding-class/search', [RidingClassController::class, 'search'])->name('riding_class.search');

    // USER PACKAGE
    Route::group(['prefix' => 'package', 'as' => 'package.'], function () {
        Route::post('/{package}/booking', [UserPackageController::class, 'booking'])->name('booking')->middleware('isProfileComplete');
        Route::post('/{package}/payment', [UserPackageController::class, 'paymentMethod'])->name('payment_method');
        Route::post('/{package}/payment-confirmation', [UserPackageController::class, 'paymentConfirmation'])->name('payment_confirmation');
        Route::put('/{package}/payment-confirmation-submit', [UserPackageController::class, 'paymentConfirmationSubmit'])->name('payment_confirmation_submit');
    });

    // USER || MEMBER END

    // STABLE START
    Route::group(['prefix' => 'stable', 'as' => 'stable.'], function () {
        Route::get('/register', [StableController::class, 'register'])->name('register')->middleware('isProfileComplete', 'isHasStable');
        Route::post('/register-submit', [StableController::class, 'registerSubmit'])->name('register.submit')->middleware('isProfileComplete');
        Route::get('/stable-key-confirm', [StableController::class, 'stableKeyConfirm'])->name('stable_key.confirm');
        Route::post('/stable-key-confirm/store', [StableController::class, 'stableKeyConfirmStore'])->name('stable_key.confirm.store');
                
        // ONLY STABLE OWNER HAD ACCESS
        Route::group(['middleware' => ['role:stable-owner', 'stableKeyConfirm']], function () {
            // STABLE EDIT
            Route::get('/edit', [StableController::class, 'edit'])->name('edit');
            Route::post('/edit/media', [StableController::class, 'storeMedia'])->name('edit.media');
            Route::put('/update', [StableController::class, 'update'])->name('update');
            
            
            //STABLE ADMIN CRUD
            Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
                Route::get('/', [StableAdminController::class, 'index'])->name('index');
                Route::get('/create', [StableAdminController::class, 'create'])->name('create');
                Route::get('/{user}/edit', [StableAdminController::class, 'edit'])->name('edit');
                Route::get('/destroy', [StableAdminController::class, 'destroy'])->name('destroy');
            });
        });

        // ONLY STABLE OWNER OR STABLE ADMIN HAD ACCESS
        Route::group(['middleware' => ['role:stable-owner|stable-admin', 'isStableProfileComplete', 'stableKeyConfirm']], function () {
            // STABLE DASHBOARD
            Route::get('/dashboard', [StableController::class, 'index'])->name('index');

            // STABLE COACH
            Route::group(['prefix' => 'coach', 'as' => 'coach.'], function () {
                Route::get('/', [CoachController::class, 'index'])->name('index');
                Route::get('/create', [CoachController::class, 'create'])->name('create');
                Route::post('/create', [CoachController::class, 'store'])->name('store');
                Route::post('/create/image', [CoachController::class, 'storeImage'])->name('store_img');
                Route::get('/{coach}/edit', [CoachController::class, 'edit'])->name('edit');
                Route::put('/{coach}/edit', [CoachController::class, 'update'])->name('update');
                Route::delete('/destroy', [CoachController::class, 'destroy'])->name('destroy');
            });
        
            // STABLE HORSE
            Route::group(['prefix' => 'horse', 'as' => 'horse.'], function () {
                Route::get('/', [HorseController::class, 'index'])->name('index');
                Route::get('/create', [HorseController::class, 'create'])->name('create');
                Route::post('/create', [HorseController::class, 'store'])->name('store');
                Route::post('/create/image', [HorseController::class, 'storeImage'])->name('store_img');
                Route::get('/{horse}/edit', [HorseController::class, 'edit'])->name('edit');
                Route::put('/{horse}/edit', [HorseController::class, 'update'])->name('update');
                Route::delete('/destroy', [HorseController::class, 'destroy'])->name('destroy');
            });
    
            // STABLE PACKAGE
            Route::group(['prefix' => 'package', 'as' => 'package.'], function () {
                Route::get('/', [PackageController::class, 'index'])->name('index');
                Route::get('/create', [PackageController::class, 'create'])->name('create');
                Route::post('/create', [PackageController::class, 'store'])->name('store');
                Route::post('/create/image', [PackageController::class, 'storeImage'])->name('store_img');
                Route::get('/{package}/edit', [PackageController::class, 'edit'])->name('edit');
                Route::put('/{package}/edit', [PackageController::class, 'update'])->name('update');
                Route::delete('/destroy', [PackageController::class, 'destroy'])->name('destroy');
            });
    
            // STABLE SCHEDULE
            Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
                Route::get('/', [ScheduleController::class, 'index'])->name('index');
                Route::get('/create', [ScheduleController::class, 'create'])->name('create');
                Route::post('/create', [ScheduleController::class, 'store'])->name('store');
                Route::get('/{schedule}/edit', [ScheduleController::class, 'edit'])->name('edit');
                Route::put('/{schedule}/edit', [ScheduleController::class, 'update'])->name('update');
                Route::delete('/destroy', [ScheduleController::class, 'destroy'])->name('destroy');
            });

            // STABLE BOOKING ORDERED
            Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
                Route::get('/', [BookingController::class, 'index'])->name('index');
            });

            // STABLE WITHDRAW
            Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function () {
                Route::get('/', [WithdrawController::class, 'index'])->name('index');
                Route::post('/store', [WithdrawController::class, 'store'])->name('store');

                // SETTINGS
                Route::get('/settings', [WithdrawController::class, 'withdrawSetting'])->name('setting');
                Route::put('/settings-store', [WithdrawController::class, 'withdrawSettingStore'])->name('setting.store');
            });
        });
    });
    // STABLE END

    // APP OWNER START
    Route::group(['prefix' => 'owner', 'as' => 'app_owner.'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

        // STABLE
        Route::group(['prefix' => 'stable', 'as' => 'stable.'], function () {

            // STABLE APPROVAL
            Route::group(['prefix' => 'approval', 'as' => 'approval.'], function () {
                Route::group(['prefix' => 'step-1', 'as' => 'step_1.'], function () {
                    Route::get('/', [StableApprovalController::class, 'step_1'])->name('index');
                    Route::get('show/{stable}', [StableApprovalController::class, 'show1'])->name('show');
                    Route::get('pending', [StableApprovalController::class, 'jsonPending1'])->name('pending');
                    Route::get('approved', [StableApprovalController::class, 'jsonApproved1'])->name('approved');
                    Route::put('approved/{stable}', [StableApprovalController::class, 'approveStable1'])->name('approve');
                    Route::get('unapproved', [StableApprovalController::class, 'jsonUnapproved1'])->name('unapproved');
                    Route::put('unapproved/{stable}', [StableApprovalController::class, 'unapproveStable1'])->name('unapprove');
                });

                Route::group(['prefix' => 'step-2', 'as' => 'step_2.'], function () {
                    Route::get('/', [StableApprovalController::class, 'step_2'])->name('index');
                    Route::get('show/{stable}', [StableApprovalController::class, 'show2'])->name('show');
                    Route::get('approved', [StableApprovalController::class, 'jsonApproved2'])->name('approved');
                    Route::put('approved/{stable}', [StableApprovalController::class, 'approveStable2'])->name('approve');
                    Route::get('unapproved', [StableApprovalController::class, 'jsonUnapproved2'])->name('unapproved');
                    Route::put('unapproved/{stable}', [StableApprovalController::class, 'unapproveStable2'])->name('unapprove');
                });
            });

            // STABLE REVIEW
            // owner/stable/12/horse
            Route::get('{stable}/horse', [StableReviewController::class, 'horse'])->name('horse');
            Route::get('{stable}/coach', [StableReviewController::class, 'coach'])->name('coach');
            Route::get('{stable}/package', [StableReviewController::class, 'package'])->name('package');
            Route::get('{stable}/schedule', [StableReviewController::class, 'schedule'])->name('schedule');
        });

        // HORSE
        Route::group(['prefix' => 'horse', 'as' => 'horse.'], function () {

            // HORSE SEX
            Route::group(['prefix' => 'horse-sex', 'as' => 'horse_sex.'], function () {
                Route::get('/', [HorseSexController::class, 'index'])->name('index');
                Route::get('create', [HorseSexController::class, 'create'])->name('create');
                Route::post('create', [HorseSexController::class, 'store'])->name('store');
                Route::get('edit/{id}', [HorseSexController::class, 'edit'])->name('edit');
                Route::put('edit/{id}', [HorseSexController::class, 'update'])->name('update');
                Route::delete('delete', [HorseSexController::class, 'destroy'])->name('delete');
            });

            // HORSE BREED
            Route::group(['prefix' => 'horse-breed', 'as' => 'horse_breed.'], function () {
                Route::get('/', [HorseBreedController::class, 'index'])->name('index');
                Route::get('create', [HorseBreedController::class, 'create'])->name('create');
                Route::post('create', [HorseBreedController::class, 'store'])->name('store');
                Route::get('edit/{id}', [HorseBreedController::class, 'edit'])->name('edit');
                Route::put('edit/{id}', [HorseBreedController::class, 'update'])->name('update');
                Route::delete('delete', [HorseBreedController::class, 'destroy'])->name('delete');
            });
        });

        // Bank Account
        Route::group(['prefix' => 'bank', 'as' => 'bank.'], function () {
            Route::get('/', [BankPaymentController::class, 'index'])->name('index');
            Route::get('create', [BankPaymentController::class, 'create'])->name('create');
            Route::post('create', [BankPaymentController::class, 'store'])->name('store');
            Route::post('/create/image', [BankPaymentController::class, 'storeImage'])->name('store_img');
            Route::get('edit/{id}', [BankPaymentController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [BankPaymentController::class, 'update'])->name('update');
            Route::delete('delete', [BankPaymentController::class, 'destroy'])->name('destroy');
        });
        
        // Payment Verification
        Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
            Route::get('verification', [UserPaymentApprovalController::class, 'index'])->name('verification');
        });
    });
    // APP OWNER END
});
