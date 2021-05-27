<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// custom load
use Illuminate\Support\Facades\Auth;

// load controllers
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\StableController;
use App\Http\Controllers\Api\HorseController;
use App\Http\Controllers\Api\CoachController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\SlotController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\BookingDetailController;
use App\Http\Controllers\Api\PaymentController;

// LOCATION
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\VillageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes();

// User API
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login-check', [AuthController::class, 'check_login']);
Route::post('/logout/{user}', [AuthController::class, 'logout']);
Route::put('/user/{user}/update', [AuthController::class, 'update']);

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);

// Stable API
Route::get('stable', [StableController::class, 'index']);
Route::post('stable', [StableController::class, 'store']);
Route::put('stable/{stable}', [StableController::class, 'update']);
Route::get('stable/{stable}', [StableController::class, 'show']);
Route::get('stable-by-user/{user}', [StableController::class, 'showByUserId']);
Route::get('stable/{stable}/dashboard', [StableController::class, 'dashboard']);
Route::post('stable/{stable}/key-confirm', [StableController::class, 'keyConfirm']);
Route::put('stable/{stable}/withdraw-setting', [StableController::class, 'withdrawSetting']);

// Horse API
Route::get('horse', [HorseController::class, 'index']);
Route::post('horse', [HorseController::class, 'store']);
Route::put('horse/{horse}', [HorseController::class, 'update']);
Route::delete('horse/{horse}', [HorseController::class, 'destroy']);
Route::get('horse/{horse}', [HorseController::class, 'show']);
Route::get('horse-by-stable/{stable}', [HorseController::class, 'showByStableId']);

// Coach API
Route::get('coach', [CoachController::class, 'index']);
Route::post('coach', [CoachController::class, 'store']);
Route::put('coach/{coach}', [CoachController::class, 'update']);
Route::delete('coach/{coach}', [CoachController::class, 'destroy']);
Route::get('coach/{coach}', [CoachController::class, 'show']);
Route::get('coach-by-stable/{stable}', [CoachController::class, 'showByStableId']);

// Package API
Route::get('package', [PackageController::class, 'index']);
Route::post('package', [PackageController::class, 'store']);
Route::put('package/{package}', [PackageController::class, 'update']);
Route::delete('package/{package}', [PackageController::class, 'destroy']);
Route::get('package/{package}', [PackageController::class, 'show']);
Route::get('package-by-stable/{stable}', [PackageController::class, 'showByStableId']);

// Slot API
Route::get('slot', [SlotController::class, 'index']);
Route::post('slot', [SlotController::class, 'store']);
Route::put('slot/{slot}', [SlotController::class, 'update']);
Route::delete('slot/{slot}', [SlotController::class, 'destroy']);
Route::get('slot/{slot}', [SlotController::class, 'show']);
Route::get('slot-by-package/{package}', [SlotController::class, 'showByPackageId']);
Route::get('slot/{slot}/user/{user}/confirmation', [SlotController::class, 'confirmation']);

// Booking CLass API
Route::get('booking', [BookingController::class, 'index']);
Route::post('booking', [BookingController::class, 'store']);
Route::get('booking/{booking}', [BookingController::class, 'show']);
Route::post('booking/{booking}/payment', [BookingController::class, 'payment']);
Route::put('booking/{booking}/approval', [BookingController::class, 'approval']);

// Booking CLass Detail API
Route::get('booking-detail', [BookingDetailController::class, 'index']);
Route::post('booking-detail', [BookingDetailController::class, 'store']);
Route::put('booking-detail/{booking_detail}', [BookingDetailController::class, 'update']);
Route::delete('booking-detail/{booking_detail}', [BookingDetailController::class, 'destroy']);
Route::get('booking-detail/{booking_detail}', [BookingDetailController::class, 'show']);
Route::get('booking-detail-by-booking/{booking}', [BookingDetailController::class, 'showByBookingId']);

// Payment API
Route::get('payment', [PaymentController::class, 'index']);
Route::post('payment', [PaymentController::class, 'store']);
Route::put('payment/{payment}', [PaymentController::class, 'update']);
Route::delete('payment/{payment}', [PaymentController::class, 'destroy']);
Route::get('payment/{payment}', [PaymentController::class, 'show']);
Route::get('payment/{payment}/approval', [PaymentController::class, 'approval']);

// Location
Route::post('city/{province}', [CityController::class, 'show']);
Route::post('district/{city}', [DistrictController::class, 'show']);
Route::post('village/{district}', [VillageController::class, 'show']);
