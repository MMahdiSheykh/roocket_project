<?php

use App\Http\Controllers\auth\GoogleAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\ActiveCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    Alert::success('Welcome', 'Your login was successful!');
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('auth')->group(function () {
    Route::get('google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
    Route::get('google/callback', [GoogleAuthController::class, 'callback']);
});

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile');

    Route::prefix('twoFactorAuth')->group(function () {
        Route::get('/', [ProfileController::class, 'mangeTwoFactor'])->name('twoFactorAuth');
        Route::post('/', [ProfileController::class, 'postManageTwoFactor']);
        Route::get('phone', [ProfileController::class, 'getPhoneVerify'])->name('twoFactorAuth.phone');
        Route::post('phone', [ProfileController::class, 'postPhoneVerify']);
    });
});
