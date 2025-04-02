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
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('home', function () {
    return view('home');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Company Routes
Route::resource('companies', CompanyController::class);

// User Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

// Evaluation Routes
Route::get('evaluations/create/{company}', [EvaluationController::class, 'create'])->name('evaluations.create');
Route::post('evaluations/store', [EvaluationController::class, 'store'])->name('evaluations.store');
Route::get('evaluations/{company}', [EvaluationController::class, 'index'])->name('evaluations.index');
Route::delete('evaluations/{evaluation}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');

// Static Pages
Route::view('/Informations-legales', 'balekenvrai.Informations-Légales')->name('Informations-legales');
Route::view('/Politique de confidentialité', 'balekenvrai.Politique-de-confidentialité')->name('Politique de confidentialité');
Route::view('/Contact', 'Contact.Contact')->name('Contact');

// Offer Routes (CRUD)
Route::resource('offers', OfferController::class);

// Postulation Routes (Requires Authentication)
Route::prefix('postulations')->name('postulations.')->middleware('auth')->group(function () {
    Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist');
    Route::get('/{id}/manage', [PostulationController::class, 'manage'])->name('manage');
    Route::put('/{id}', [PostulationController::class, 'update'])->name('update');
    Route::delete('/{id}', [PostulationController::class, 'destroy'])->name('delete');
    Route::post('/offer/{id}/apply', [PostulationController::class, 'store'])->name('apply');
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
Route::post('/postuler', [PostulationController::class, 'postuler'])->name('postuler');
Route::get('/offer/{id}/apply', [PostulationController::class, 'create'])->name('postulation.create');
Route::post('/offer/{id}/apply', [PostulationController::class, 'store'])->name('postulation.store');
Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist');