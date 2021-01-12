<?php

use Illuminate\Support\Facades\Route;

// custom load Facades
use Illuminate\Support\Facades\Auth;

// load controllers
use App\Http\Controllers\HomeController;

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
