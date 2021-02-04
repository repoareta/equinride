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
use App\Http\Controllers\BookingController;

// LOAD USER CONTROLLER END

// LOAD STABLE CONTROLLER FOR STABLE OWNER AND STABLE ADMIN START
use App\Http\Controllers\Stable\StableController;
use App\Http\Controllers\Stable\HorseController;
use App\Http\Controllers\Stable\CoachController;
use App\Http\Controllers\Stable\PackageController;
use App\Http\Controllers\Stable\ScheduleController;

// LOAD STABLE CONTROLLER FOR STABLE OWNER AND STABLE ADMIN END

// LOAD APP OWNER CONTROLLER FOR APP OWNER AND APP ADMIN START
use App\Http\Controllers\AppOwner\DashboardController;
use App\Http\Controllers\AppOwner\BankPaymentController;
use App\Http\Controllers\AppOwner\HorseBreedController;
use App\Http\Controllers\AppOwner\HorseSexController;
use App\Http\Controllers\AppOwner\StableApprovalController;
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
        Route::get('/register', [StableController::class, 'register'])->name('register')->middleware('isProfileComplete');
        Route::post('/register-submit', [StableController::class, 'registerSubmit'])->name('register.submit')->middleware('isProfileComplete');
                
        // ONLY STABLE OWNER HAD ACCESS
        Route::group(['middleware' => ['role:stable-owner']], function () {
            // STABLE EDIT
            Route::get('/edit', [StableController::class, 'edit'])->name('edit');
            Route::post('/edit/media', [StableController::class, 'storeMedia'])->name('edit.media');
            Route::put('/update', [StableController::class, 'update'])->name('update');
            
            //STABLE ADMIN CRUD
            Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
                Route::get('/', [StableAdminController::class, 'index'])->name('index');
                Route::get('/create', [StableAdminController::class, 'create'])->name('create');
                Route::get('/{admin}/edit', [StableAdminController::class, 'edit'])->name('edit');
                Route::get('/destroy', [StableAdminController::class, 'destroy'])->name('destroy');
            });
        });

        // ONLY STABLE OWNER OR STABLE ADMIN HAD ACCESS
        Route::group(['middleware' => ['role:stable-owner|stable-admin', 'isStableProfileComplete']], function () {
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
                Route::post('/create', [PackageController::class, 'store'])->name('store');
                Route::get('/{package}/edit', [PackageController::class, 'edit'])->name('edit');
                Route::put('/{pacakge}/edit', [PackageController::class, 'update'])->name('update');
                Route::delete('/destroy', [ScheduleController::class, 'destroy'])->name('destroy');
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
                Route::get('/step-1', [StableApprovalController::class, 'step_1'])->name('step_1');
                Route::get('/step-2', [StableApprovalController::class, 'step_2'])->name('step_2');
            });
        });

        // Horse
        Route::group(['prefix' => 'horse', 'as' => 'horse.'], function () {

            // Horse Sex
            Route::group(['prefix' => 'horse-sex', 'as' => 'horse_sex.'], function () {
                Route::get('/', [HorseSexController::class, 'index'])->name('index');
                Route::get('list/json', [HorseSexController::class, 'listJson'])->name('list.json');
                Route::post('store', [HorseSexController::class, 'store'])->name('store');
                Route::get('edit/{id}', [HorseSexController::class, 'edit'])->name('edit');
                Route::put('update', [HorseSexController::class, 'update'])->name('update');
                Route::delete('delete', [HorseSexController::class, 'delete'])->name('delete');
            });

            // Horse Breed
            Route::group(['prefix' => 'horse-breed', 'as' => 'horse_breed.'], function () {
                Route::get('/', [HorseBreedController::class, 'index'])->name('index');
                Route::get('list/json', [HorseBreedController::class, 'listJson'])->name('list.json');
                Route::post('store', [HorseBreedController::class, 'store'])->name('store');
                Route::get('edit/{id}', [HorseBreedController::class, 'edit'])->name('edit');
                Route::put('update', [HorseBreedController::class, 'update'])->name('update');
                Route::delete('delete', [HorseBreedController::class, 'delete'])->name('delete');
            });
        });

        // Bank Account
        Route::group(['prefix' => 'bank', 'as' => 'bank.'], function () {
            Route::get('/', [BankPaymentController::class, 'index'])->name('index');
            route::get('list/json', [BankPaymentController::class, 'listJson'])->name('list.json');
            Route::post('store', [BankPaymentController::class, 'store'])->name('store');
            Route::get('edit/{id}', [BankPaymentController::class, 'edit'])->name('edit');
            Route::put('update', [BankPaymentController::class, 'update'])->name('update');
            Route::delete('delete', [BankPaymentController::class, 'delete'])->name('delete');
        });
        
        // Payment Verification
        Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
            Route::get('verification', [UserPaymentApprovalController::class, 'index'])->name('verification');
        });
    });
    // APP OWNER END
});
