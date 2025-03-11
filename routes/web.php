<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

// Lobby/Homepage
Route::get('/', function () {
    return view('lobby');
})->name('lobby');

// Public access to companies, offers, and users
Route::resource('companies', CompanyController::class)->only(['index', 'show']);
Route::resource('offers', OfferController::class)->only(['index', 'show']);
Route::resource('users', UserController::class);

// Explicit show routes for better clarity (optional but clearer)
Route::get('offers/{offer}', [OfferController::class, 'show'])->name('offers.show');
Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');


// Admin Middleware for restricted CRUD actions (Create, Update, Delete)
/*Route::middleware(['admin'])->group(function () {
    Route::resource('companies', CompanyController::class)->except(['index', 'show']);
    Route::resource('offers', OfferController::class)->except(['index', 'show']);
    Route::resource('users', UserController::class)->except(['index', 'show']);
});
*/
// Custom login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (protected route for logged-in users)
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard')->middleware('auth');