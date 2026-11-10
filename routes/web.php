<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrontdeskController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MemberDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest / Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [GuestController::class, 'index'])->name('home');
Route::view('/kalkulator-bmi', 'bmi.bmi')->name('bmi.index');
Route::get('/register', [GuestController::class, 'showRegister'])->name('register');
Route::post('/register-interest', [GuestController::class, 'registerInterest'])->name('register.interest');
Route::post('/register', [GuestController::class, 'store'])->name('guest.register');

// Pricing Routes
Route::get('/pricing/membership', [GuestController::class, 'pricingMembership'])->name('pricing.membership');
Route::get('/pricing/pt-single', [GuestController::class, 'pricingPtSingle'])->name('pricing.pt-single');
Route::get('/pricing/pt-couples', [GuestController::class, 'pricingPtCouples'])->name('pricing.pt-couples');
Route::redirect('/pricing', '/#pricing')->name('pricing.index');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'showResetPassword'])->name('password.request');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset');

// Direct Preview Route for Member Portal
Route::get('/member-preview', [MemberDashboardController::class, 'preview'])->name('member.preview');

/*
|--------------------------------------------------------------------------
| Admin & Staff Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Frontdesk
    Route::get('/frontdesk', [FrontdeskController::class, 'index'])->name('frontdesk.index');
    Route::post('/frontdesk/checkin', [FrontdeskController::class, 'checkIn'])->name('frontdesk.checkin');
    Route::post('/frontdesk/daily-guest', [FrontdeskController::class, 'dailyGuest'])->name('frontdesk.daily-guest');

    // Members
    Route::resource('members', MemberController::class);
    Route::post('/members/{member}/renew', [MemberController::class, 'renew'])->name('members.renew');
    Route::post('/members/{member}/verify', [MemberController::class, 'verify'])->name('members.verify');
});

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
});
