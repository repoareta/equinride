<?php

use Illuminate\Support\Facades\Route;

// custom load Facades
use Illuminate\Support\Facades\Auth;

// load controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RidingClassController;

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

// RIDING CLASS
Route::get('/riding-class', [RidingClassController::class, 'index'])->name('riding_class');
Route::get('/riding-class/search', [RidingClassController::class, 'search'])->name('riding_class.search');
Route::get('/riding-class/package/{package}/booking', [RidingClassController::class, 'booking'])->name('riding_class.package.booking');
Route::get('/riding-class/package/{package}/payment', [RidingClassController::class, 'payment'])->name('riding_class.package.payment');
