<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PostulationController;

// Home Routes
Route::view('/', 'home')->name('home');
Route::view('home', 'home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Static Pages
Route::view('/Informations-legales', 'footer.Legal-information')->name('Informations-legales');
Route::view('/Politique-de-confidentialité', 'footer.Privacy-policy')->name('Politique de confidentialité');
Route::view('/Contact', 'contact.contact')->name('Contact');

// Company Routes
Route::resource('companies', CompanyController::class);

// User Routes (Requires Authentication)
Route::view('/Profil', 'users.dashboard')->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

});

// Evaluation Routes
Route::prefix('evaluations')->group(function () {
    Route::get('create/{company}', [EvaluationController::class, 'create'])->name('evaluations.create');
    Route::post('store', [EvaluationController::class, 'store'])->name('evaluations.store');
    Route::get('{company}', [EvaluationController::class, 'index'])->name('evaluations.index');
    Route::delete('{evaluation}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');
});

// Offer Routes (CRUD)
Route::resource('offers', OfferController::class);

// Postulation Routes (Requires Authentication)
Route::middleware('auth')->prefix('postulations')->name('postulations.')->group(function () {
    Route::get('/create/{offer}', [PostulationController::class, 'create'])->name('create');
    Route::post('/store/{offer}', [PostulationController::class, 'store'])->name('store');
    Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist');
    Route::get('/{id}/show', [PostulationController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [PostulationController::class, 'edit'])->name('edit');
    Route::put('/edit/{id}', [PostulationController::class, 'update'])->name('update');
    Route::delete('/{id}', [PostulationController::class, 'destroy'])->name('delete');
});

// Wishlist Routes (Requires Authentication)
Route::middleware('auth')->prefix('wishlist')->name('wishlist.')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/add', [WishlistController::class, 'add'])->name('add');
    Route::post('/remove', [WishlistController::class, 'remove'])->name('remove');
    Route::get('/{id}', [WishlistController::class, 'show'])->name('show');
});

// Additional Routes
Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index');

// Admin Panel Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard/{id?}', [UserController::class, 'dashboard'])->name('users.dashboard');
    Route::view('/Panneau_de_Configuration', 'admin.Pannel')->name('Panneau_de_Configuration');

    // Contact Management
    Route::prefix('support')->name('admin.support.')->group(function () {
        Route::get('/index', [ContactController::class, 'adminContacts'])->name('index');
        Route::get('/{contact}', [ContactController::class, 'show'])->name('show');
        Route::put('/{contact}', [ContactController::class, 'update'])->name('update');
        Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('destroy');
        Route::post('/{contact}/status', [ContactController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/download/{contactId}', [ContactController::class, 'download'])->name('download');
    });
});

// Contact Routes
Route::prefix('contact')->group(function () {
    Route::post('/', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/success', [ContactController::class, 'success'])->name('contact.success');
    Route::get('/download/{contactId}', [ContactController::class, 'download'])->name('contact.download');
});
