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
        Route::get('/personal-information', [UserController::class, 'personalInformation'])->name('personal_information');
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('change_password');
        Route::get('/order-history', [UserController::class, 'changePassword'])->name('change_password');
    });

    // USER RIDING CLASS
    Route::get('/riding-class', [RidingClassController::class, 'index'])->name('riding_class');
    Route::get('/riding-class/search', [RidingClassController::class, 'search'])->name('riding_class.search');

    // USER PACKAGE
    Route::group(['prefix' => 'package', 'as' => 'package.'], function () {
        Route::get('/{package}/booking', [UserPackageController::class, 'booking'])->name('booking');
        Route::get('/{package}/payment', [UserPackageController::class, 'paymentMethod'])->name('payment_method');
        Route::get('/{package}/payment-confirmation', [UserPackageController::class, 'paymentConfirmation'])->name('payment_confirmation');
    });

    // USER || MEMBER END

    // STABLE OWNER || STABLE ADMIN START
    Route::group(['prefix' => 'stable', 'as' => 'stable.'], function () {
        Route::get('/register', [StableController::class, 'register'])->name('register');
        Route::get('/dashboard', [StableController::class, 'index'])->name('index');
        Route::get('/{stable}/edit', [StableController::class, 'index'])->name('edit');
    
        // STABLE COACH
        Route::group(['prefix' => 'coach', 'as' => 'coach.'], function () {
            Route::get('/', [CoachController::class, 'index'])->name('index');
            Route::get('/create', [CoachController::class, 'create'])->name('create');
            Route::get('/{coach}/edit', [CoachController::class, 'edit'])->name('edit');
            Route::get('/destroy', [CoachController::class, 'destroy'])->name('destroy');
        });
        
        // STABLE HORSE
        Route::group(['prefix' => 'horse', 'as' => 'horse.'], function () {
            Route::get('/', [HorseController::class, 'index'])->name('index');
            Route::get('/create', [HorseController::class, 'create'])->name('create');
            Route::get('/{horse}/edit', [HorseController::class, 'edit'])->name('edit');
            Route::get('/destroy', [HorseController::class, 'destroy'])->name('destroy');
        });
    
        // STABLE PACKAGE
        Route::group(['prefix' => 'package', 'as' => 'package.'], function () {
            Route::get('/', [PackageController::class, 'index'])->name('index');
            Route::get('/create', [PackageController::class, 'create'])->name('create');
            Route::get('/{package}/edit', [PackageController::class, 'edit'])->name('edit');
            Route::get('/destroy', [PackageController::class, 'destroy'])->name('destroy');
        });
    
        // STABLE SCHEDULE
        Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('index');
            Route::get('/destroy', [ScheduleController::class, 'destroy'])->name('destroy');
        });
    });
    // STABLE OWNER || STABLE ADMIN END

    // APP OWNER START
    Route::group(['prefix' => 'owner', 'as' => 'app_owner.'], function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

        // STABLE
        Route::group(['prefix' => 'stable', 'as' => 'stable.'], function() {

            // STABLE APPROVAL
            Route::group(['prefix' => 'approval', 'as' => 'approval.'], function() {
                Route::get('/step-1', [StableApprovalController::class, 'step_1'])->name('step_1');
                Route::get('/step-2', [StableApprovalController::class, 'step_2'])->name('step_2');
            });

            

        });

        // Horse
        Route::group(['prefix' => 'horse', 'as' => 'horse.'], function() {

            // Horse Sex
            Route::group(['prefix' => 'horse-sex', 'as' => 'horse_sex.'], function() {
                Route::get('/', [HorseSexController::class, 'index'])->name('index');
                Route::get('list/json', [HorseSexController::class, 'listJson'])->name('list.json');
                Route::post('store', [HorseSexController::class, 'store'])->name('store');
                Route::get('edit/{id}', [HorseSexController::class, 'edit'])->name('edit');
                Route::patch('update', [HorseSexController::class, 'update'])->name('update');
                Route::delete('delete', [HorseSexController::class, 'delete'])->name('delete');
            });

            // Horse Breed
            Route::group(['prefix' => 'horse-breed', 'as' => 'horse_breed.'], function() {
                Route::get('/', [HorseBreedController::class, 'index'])->name('index');
                Route::get('list/json', [HorseBreedController::class, 'listJson'])->name('list.json');
                Route::post('store', [HorseBreedController::class, 'store'])->name('store');
                Route::get('edit/{id}', [HorseBreedController::class, 'edit'])->name('edit');
                Route::patch('update', [HorseBreedController::class, 'update'])->name('update');
                Route::delete('delete', [HorseBreedController::class, 'delete'])->name('delete');
            });

            
        });

        // Bank Account
        Route::group(['prefix' => 'bank', 'as' => 'bank.'], function () {
            Route::get('/', [BankPaymentController::class, 'index'])->name('index');
            route::get('list/json', [BankPaymentController::class, 'listJson'])->name('list.json');
            Route::post('store', [BankPaymentController::class, 'store'])->name('store');
            Route::get('edit/{id}', [BankPaymentController::class, 'edit'])->name('edit');
            Route::patch('update', [BankPaymentController::class, 'update'])->name('update');
            Route::delete('delete', [BankPaymentController::class, 'delete'])->name('delete');
        });
        
        // Payment Verification
        Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
            Route::get('verification', [UserPaymentApprovalController::class, 'index'])->name('verification');
        });

    });
    // APP OWNER END
});
