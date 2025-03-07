<?php


use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/', function () {
    return view('lobby');
});

Route::resource('companies', CompanyController::class);
Route::resource('offers', OfferController::class);

Route::get('offers/{offer}', [OfferController::class, 'show'])->name('offers.show');
Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies.show');

// Admin Middleware for CRUD actions
Route::middleware(['admin'])->group(function () {
    Route::resource('companies', CompanyController::class)->except(['index', 'show']);
    Route::resource('offers', OfferController::class)->except(['index', 'show']);
});

Route::get('/admin', [DashboardController::class, 'index'])->name('admin.index');
