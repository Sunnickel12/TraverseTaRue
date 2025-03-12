<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ControlPanelController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// Lobby/Homepage
Route::get('/', function () {
    return view('lobby');
})->name('lobby');

// Public access to companies, offers, and users
Route::resource('companies', CompanyController::class);
Route::resource('offers', OfferController::class)->only(['index', 'show']);
Route::resource('users', UserController::class);

// Explicit show routes for better clarity (optional but clearer)
Route::get('offers/{offer}', [OfferController::class, 'show'])->name('offers.show');
Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');

// Custom login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (protected route for logged-in users)
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Role-based Control Panel Routes (authentication list approach)
Route::middleware('auth')->group(function () {

    // Control Panel - Base (Control Panel Dashboard)
    Route::get('/control-panel', [ControlPanelController::class, 'index'])->name('control.panel');

    // Control Panel - Admin Access
    Route::get('/control-panel/admin', [ControlPanelController::class, 'admin'])->name('control.panel.admin');

    // Control Panel - Professor Access
    Route::get('/control-panel/professor', [ControlPanelController::class, 'professor'])->name('control.panel.professor');

    // Control Panel - Student Access
    Route::get('/control-panel/student', [ControlPanelController::class, 'student'])->name('control.panel.student');
});

// Admin Control Panel (admin route for users with role "admin")
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});
