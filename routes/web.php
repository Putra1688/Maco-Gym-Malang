<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

/*
|--------------------------------------------------------------------------
| Guest / Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [GuestController::class, 'store'])->name('guest.register');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Member Routes (nanti)
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
//     Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');
//     Route::resource('/profile', PhysicalProfileController::class);
// });

/*
|--------------------------------------------------------------------------
| Admin Routes (nanti)
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//     Route::resource('/members', AdminMemberController::class);
//     Route::resource('/products', ProductController::class);
//     Route::resource('/trainers', TrainerController::class);
// });
