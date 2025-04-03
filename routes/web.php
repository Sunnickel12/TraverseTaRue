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
use App\Http\Controllers\AdminContactController;

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
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

// Evaluation Routes
Route::get('evaluations/create/{company}', [EvaluationController::class, 'create'])->name('evaluations.create');
Route::post('evaluations/store', [EvaluationController::class, 'store'])->name('evaluations.store');
Route::get('evaluations/{company}', [EvaluationController::class, 'index'])->name('evaluations.index');
Route::delete('evaluations/{evaluation}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');

// Static Pages
Route::view('/Informations-legales', 'balekenvrai.Informations-Légales')->name('Informations-legales');
Route::view('/Politique-de-confidentialité', 'balekenvrai.Politique-de-confidentialité')->name('Politique de confidentialité');
Route::view('/Contact', 'contact.contact')->name('Contact');

// Offer Routes (CRUD)
Route::resource('offers', OfferController::class);

// Postulation Routes (Requires Authentication)
Route::prefix('postulations')->name('postulations.')->middleware('auth')->group(function () {
    Route::get('/create/{offer}', [PostulationController::class, 'create'])->name('create'); // Create postulation form
    Route::post('/store/{offer}', [PostulationController::class, 'store'])->name('store'); // Store postulation
    Route::get('/wishlist', [PostulationController::class, 'wishlist'])->name('wishlist'); // Wishlist
    Route::get('/{id}/show', [PostulationController::class, 'show'])->name('show'); // Show specific postulation
    Route::get('/edit/{id}', [PostulationController::class, 'edit'])->name('edit'); // Display edit form
    Route::put('/edit/{id}', [PostulationController::class, 'update'])->name('update'); // Update postulation
    Route::delete('/{id}', [PostulationController::class, 'destroy'])->name('delete'); // Soft delete postulation
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

// Pannel Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/{id?}', [UserController::class, 'dashboard'])->name('users.dashboard');
});

Route::view('/Panneau_de_Configuration', 'admin.Pannel')->name('Panneau_de_Configuration');
Route::view('/Gestion_des_Messages', 'admin.contacts.index')->name('GestionContact');

Route::get('/contact/contactsuccess', function () {
    return view('contact/contactsuccess');
})->name('contact.success');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Liste des demandes de contact
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');

    // Détail d'une demande de contact
    Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');

    // Mettre à jour le statut d'une demande de contact
    Route::post('/contacts/{id}/status', [AdminContactController::class, 'updateStatus'])->name('contacts.updateStatus');
});
