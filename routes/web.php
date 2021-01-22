<?php

use Illuminate\Support\Facades\Route;

// custom load Facades
use Illuminate\Support\Facades\Auth;

// LOAD USER CONTROLLER START
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RidingClassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController as UserPackageController; // USE 'AS' BECAUSE CONFLICT WITH STABLE PACKAGE CONTROLLER NAME

// LOAD USER CONTROLLER START

// LOAD STABLE CONTROLLER FOR STABLE OWNER AND STABLE ADMIN START
use App\Http\Controllers\Stable\StableController;
use App\Http\Controllers\Stable\HorseController;
use App\Http\Controllers\Stable\CoachController;
use App\Http\Controllers\Stable\PackageController;
use App\Http\Controllers\Stable\ScheduleController;
use App\Http\Controllers\AppOwner\DashboardController;

// LOAD STABLE CONTROLLER FOR STABLE OWNER AND STABLE ADMIN END

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
    
    
    
    // STABLE OWNER || STABLE ADMIN
    Route::group(['prefix' => 'stable', 'as' => 'stable.', 'namespace' => 'Stable'], function () {
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
});




// APP OWNER
Route::get('/app-owner/dashboard', [DashboardController::class, 'index'])->name('app_owner.index');

// Payment Approval
