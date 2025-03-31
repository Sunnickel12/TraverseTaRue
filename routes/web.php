<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ControlPanelController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostulationController;

// Lobby/Homepage
Route::get('/', function () {
    return view('lobby');
})->name('lobby');

// Public access to companies, offers, and users
Route::resource('companies', CompanyController::class)->parameters([
    'companies' => 'company:id_companie'
]);
Route::resource('offers', OfferController::class);
Route::resource('users', UserController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // List users
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Show create form
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Store new user
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show'); // Show user details
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Show edit form
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Update user
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete user
});


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

Route::get('/offers/search', [OfferController::class, 'search'])->name('offers.search');
Route::get('/companies/search', [CompanyController::class, 'search'])->name('companies.search');

Route::middleware(['auth'])->group(function () {
    Route::get('/offers/{id_offer}/postulate', [PostulationController::class, 'create'])->name('postulations.create');
    Route::post('/offers/{id_offer}/postulate', [PostulationController::class, 'store'])->name('postulations.store');
});

use App\Http\Controllers\UserDashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});