<?php

use Illuminate\Support\Facades\Route;

// custom load Facades
use Illuminate\Support\Facades\Auth;

// load controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RidingClassController;

// Load controller stable
use App\Http\Controllers\Stable\StableController;

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
})->name('profile.personal-information');

Route::get('/profile/change_password', function () {
    return view('user.change-password');
})->name('profile.change-password');

// RIDING CLASS
Route::get('/riding-class', [RidingClassController::class, 'index'])->name('riding_class');
Route::get('/riding-class/search', [RidingClassController::class, 'search'])->name('riding_class.search');

// PACKAGE
Route::get('/package/{package}/booking', [RidingClassController::class, 'booking'])->name('package.booking');
Route::get('/package/{package}/payment', [RidingClassController::class, 'paymentMethod'])->name('package.payment_method');
Route::get('/package/{package}/payment-confirmation', [RidingClassController::class, 'paymentConfirmation'])->name('package.payment_confirmation');

// STABLE
Route::get('/stable/dashboard', [StableController::class, 'index'])->name('stable.index');
Route::get('/stable/{stable}/edit', [StableController::class, 'index'])->name('stable.index');

// COACH
Route::get('/stable/coach', [CoachController::class, 'index'])->name('stable.coach.index');
Route::get('/stable/coach/create', [CoachController::class, 'create'])->name('stable.coach.index');
Route::get('/stable/coach/{coach}/edit', [CoachController::class, 'edit'])->name('stable.coach.index');
Route::get('/stable/coach/{coach}/destroy', [CoachController::class, 'destroy'])->name('stable.coach.index');

// HORSE
Route::get('/stable/horse', [HorseController::class, 'index'])->name('stable.horse.index');
Route::get('/stable/horse/create', [HorseController::class, 'index'])->name('stable.horse.index');
Route::get('/stable/horse/{horse}/edit', [HorseController::class, 'index'])->name('stable.horse.index');
Route::get('/stable/horse/{horse}/destroy', [HorseController::class, 'index'])->name('stable.horse.index');

// SCHEDULE
Route::get('/stable/schedule', [HorseController::class, 'index'])->name('stable.schedule.index');

// APP OWNER
Route::get('/app-owner/dashboard', [DashboardController::class, 'index'])->name('app_owner.index');

// Payment Approval
