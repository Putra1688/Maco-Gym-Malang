<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FrontdeskController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\TransactionController;
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
Route::post('/register-interest', [GuestController::class, 'registerInterest'])->name('register.interest');
Route::post('/register', [GuestController::class, 'store'])->name('guest.register');

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

    // Packages
    Route::resource('packages', PackageController::class)->except(['show']);

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Trainers
    Route::resource('trainers', TrainerController::class)->except(['show']);
});

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [MemberDashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/progress', [MemberDashboardController::class, 'storeProgress'])->name('progress.store');
    Route::post('/routine/{routine}/toggle', [MemberDashboardController::class, 'toggleRoutineExercise'])->name('routine.toggle');
    Route::post('/routine/{routine}/exercise', [MemberDashboardController::class, 'addRoutineExercise'])->name('routine.exercise.add');
    Route::delete('/routine/{routine}/exercise/{index}', [MemberDashboardController::class, 'deleteRoutineExercise'])->name('routine.exercise.delete');
    Route::post('/routine/{routine}/reset', [MemberDashboardController::class, 'resetRoutineChecklist'])->name('routine.reset');
    Route::post('/routine/template', [MemberDashboardController::class, 'applyRoutineTemplate'])->name('routine.template');
});
