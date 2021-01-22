<?php

use Illuminate\Support\Facades\Route;

// custom load Facades
use Illuminate\Support\Facades\Auth;

// load controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RidingClassController;

// Load controller stable
use App\Http\Controllers\Stable\StableController;

// Load controller stable horse
use App\Http\Controllers\Stable\HorseController;

// Load controller stable coach
use App\Http\Controllers\Stable\CoachController;

// Load controller stable package
use App\Http\Controllers\Stable\PackageController;

// Load controller stable package
use App\Http\Controllers\Stable\ScheduleController;

// Load controller app-owner
use App\Http\Controllers\AppOwner\DashboardController;


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

Auth::routes([
    'verify' => 'true'
]);

// Route::group(['middleware' => ['auth', 'verified']], function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });

Route::get('/home', [HomeController::class, 'index'])->name('home');

// USER PROFILE
Route::get('/profile', function () {
    return view('user.personal-information');
})->name('profile.personal_information');

Route::get('/profile/change_password', function () {
    return view('user.change-password');
})->name('profile.change_password');

// RIDING CLASS
Route::get('/riding-class', [RidingClassController::class, 'index'])->name('riding_class');
Route::get('/riding-class/search', [RidingClassController::class, 'search'])->name('riding_class.search');

// PACKAGE
Route::get('/package/{package}/booking', [RidingClassController::class, 'booking'])->name('package.booking');
Route::get('/package/{package}/payment', [RidingClassController::class, 'paymentMethod'])->name('package.payment_method');
Route::get('/package/{package}/payment-confirmation', [RidingClassController::class, 'paymentConfirmation'])->name('package.payment_confirmation');

// STABLE
Route::get('/stable/dashboard', [StableController::class, 'index'])->name('stable.index');
Route::get('/stable/{stable}/edit', [StableController::class, 'index'])->name('stable.edit');

// STABLE COACH
Route::get('/stable/coach', [CoachController::class, 'index'])->name('stable.coach.index');
Route::get('/stable/coach/create', [CoachController::class, 'create'])->name('stable.coach.create');
Route::get('/stable/coach/{coach}/edit', [CoachController::class, 'edit'])->name('stable.coach.edit');
Route::get('/stable/coach/destroy', [CoachController::class, 'destroy'])->name('stable.coach.destroy');

// STABLE HORSE
Route::get('/stable/horse', [HorseController::class, 'index'])->name('stable.horse.index');
Route::get('/stable/horse/create', [HorseController::class, 'create'])->name('stable.horse.create');
Route::get('/stable/horse/{horse}/edit', [HorseController::class, 'edit'])->name('stable.horse.edit');
Route::get('/stable/horse/destroy', [HorseController::class, 'destroy'])->name('stable.horse.destroy');

// STABLE HORSE
Route::get('/stable/package', [PackageController::class, 'index'])->name('stable.package.index');
Route::get('/stable/package/create', [PackageController::class, 'create'])->name('stable.package.create');
Route::get('/stable/package/{package}/edit', [PackageController::class, 'edit'])->name('stable.package.edit');
Route::get('/stable/package/destroy', [PackageController::class, 'destroy'])->name('stable.package.destroy');

// SCHEDULE
Route::get('/stable/schedule', [ScheduleController::class, 'index'])->name('stable.schedule.index');
Route::get('/stable/schedule/destroy', [ScheduleController::class, 'destroy'])->name('stable.schedule.destroy');
// APP OWNER
Route::get('/app-owner/dashboard', [DashboardController::class, 'index'])->name('app_owner.index');

// Payment Approval
